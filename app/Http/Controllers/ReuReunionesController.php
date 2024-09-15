<?php

namespace App\Http\Controllers;

use App\Models\ReuAsistentes;
use App\Models\ReuReunion;
use App\Models\User;
use App\Notifications\CrearReunionNotification;
use App\Notifications\NotificationReunionCreated;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ReuReunionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $reuniones = ReuReunion::orderBy('fechaInicio', 'DESC')->get();
        } else {
            $reuniones = ReuReunion::where('user_id', Auth::user()->id)
                ->orderBy('fechaInicio', 'DESC')
                ->get();
        }

        return Inertia::render('Reuniones/Index', compact('reuniones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Reuniones/Form', ['gerencias' => gerenciasHelper()]); //Uso del Helper gerencias());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ReuReunion $reunione)
    {
        // dd(Auth::user()->id);
        try {
            $request->validate([
                'tema' => 'required|max:150',
                'instructor' => 'required|max:150',
                'lugar' => 'required|max:150',
                'responsable' => 'required|max:100',
                'empresa' => 'required|max:150',
                'gerencia' => 'nullable',
                'fechaInicio' => 'required|date',
                'fechaFinal' => 'required|date|after_or_equal:fechaInicio',
            ], [
                'tema' => 'El campo tema es obligatorio',
                'instructor' => 'El campo instructor es obligatorio',
                'lugar' => 'El campo lugar es obligatorio',
                'responsable' => 'El campo responsable es obligatorio',
                'empresa' => 'El campo empresa es obligatorio',
                'gerencia' => 'El campo Gerencia es obligatorio',
                'fechaInicio' => 'El campo Fecha Inicio es obligatorio',
                'fechaFinal' => 'La Fecha de Finalización debe ser igual o posterior a la fecha de inicio.',
            ]);

            $user = Auth::user();

            $reunion = ReuReunion::create([
                'user_id' => $user->id,
                'tema' => $request->tema,
                'instructor' => $request->instructor,
                'lugar' => $request->lugar,
                'responsable' => $request->responsable,
                'empresa' => $request->empresa,
                'gerencia' => $request->gerencia,
                'fechaInicio' => $request->fechaInicio,
                'fechaFinal' => $request->fechaFinal,
                'activo' => true,
                // 'reureuniones_id' => $request->reureuniones_id
            ]);

            //?Envío de notificación por email.
            $user->notify(new NotificationReunionCreated($reunion, $user, 'Reunión Creada'));

            return redirect()->route(
                'reuniones.index',
                [
                    'reuniones' => ReuReunion::where(
                        'user_id',
                        Auth::user()->id
                    )
                        ->orderBy('fechaInicio', 'DESC')
                        ->get()
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar la solicitud.' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(ReuReunion $reunione)
    {
        return Inertia::render(
            'Reuniones/Form',
            [
                'reunion' => $reunione,
                'gerencias' => gerenciasHelper(),
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReuReunion $reunione)
    {
        // dd(Carbon::parse($request->fechaInicio)->subHour(5));
        try {
            $validateData = $request->validate([
                'tema' => 'required',
                'instructor' => 'required',
                'lugar' => 'required',
                'responsable' => 'required',
                'empresa' => 'required',
                'gerencia' => 'nullable',
                'fechaInicio' => 'required',
                'fechaFinal' => 'required|after_or_equal:fechaInicio',
            ]);

            $reunione->update($validateData);

            return redirect()->route(
                'reuniones.index',
                [
                    'reuniones' => ReuReunion::where('user_id', Auth::user()->id)
                        ->orderBy('fechaInicio', 'DESC')
                        ->get()
                ]
            );
            // return back()->with(['success' => 'mensaje: ']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'mensaje: ', $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReuReunion $reunione)
    {
        $reunione->delete();
        // Storage::disk('public')->delete($reunione->qr);
    }

    public function agregarUsuariosAReunion(Request $request, $id)
    {
        try {
            foreach ($request->empleadosRegistrados as $empleado) {
                $user = ReuAsistentes::firstOrNew([
                    'identificacion' => $empleado['IDENTIFICACION'],
                    'reureunion_id' => $id,
                ]);

                $user->name = $empleado['APELLIDOS_NOMBRES'];
                $user->email = $empleado['EMAIL_CORP'];
                $user->cargo = $empleado['CARGO'];
                $user->gerencia = $empleado['GERENCIA'];
                $user->save();

                $user->notify(new NotificationReunionCreated(ReuReunion::find($id), $user, 'Te han invitado a una Reunión'));
            }

            return response()->json(['message' => 'Usuario(os) añadidos y notificados exitosamente'], 200);
        } catch (Exception $e) {
            return back()->withErrors('message', 'Ha ocurrido un error al enviar la invitación', $e->getMessage());
        };
    }

    public function generateAsistantsListPDF($id)
    {
        $image = '/img/cotecmar-logo.png';
        $reunion = ReuReunion::with('asistentes')->find($id); //With para llamar la relación en el modelo

        $formatDate = Carbon::parse($reunion->fechaInicio)->format('d/m/Y');

        $asistentesData = $reunion->asistentes->map(function ($asistente) {
            return [
                'cargo' => $asistente->cargo,
                'gerencia' => $asistente->gerencia,
            ];
        });

        $validateGerenciaData = $reunion->gerencia == null ? 'N/A' : $reunion->gerencia;

        $pdf = Pdf::loadView('pdf.asistencia', compact('reunion', 'image', 'asistentesData', 'formatDate', 'validateGerenciaData'));
        // $pdf = Pdf::loadView('pdf.asistencia_test', compact('reunion', 'image', 'asistentesData', 'formatDate', 'validateGerenciaData'));
        return $pdf->stream('lista_de_asistentes_' . $formatDate . '.pdf');
    }

    public function eliminarUsuariosDeReunion(Request $request)
    {
        $request->delete();

        return response()->json(['message' => 'Usuario eliminado de la reunión']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ReuAsistentes;
use App\Models\ReuReunion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class ReuAsistentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //* ReuAsistentes es el modelo
    /**
     * The index function renders a form view with the ReuAsistentes data using the Inertia framework
     * in PHP.
     *
     * @param ReuAsistentes reuasistentes The parameter `` is an instance of the
     * `ReuAsistentes` class. It is being passed to the `index` function as a dependency injection.
     * @return a rendered view called 'Asistencias/Form' with the variable 'reuasistentes' passed to
     * it.
     */
    public function index(ReuAsistentes $reuasistentes)
    {
        return Inertia::render('Asistencias/Form', compact('reuasistentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * The create function decrypts an ID, retrieves a ReuReunion model based on the decrypted ID, and
     * renders a form view with the retrieved model.
     *
     * @param Request request The  parameter is an instance of the Request class, which
     * represents the HTTP request made to the server. It contains information such as the request
     * method, headers, and input data.
     * @param id The  parameter is the encrypted ID of a ReuReunion model.
     * @return a rendered Inertia view called 'Asistencias/Form' with the 'reureunion' variable passed
     * to the view.
     */
    public function create($id, $asistenteId = 0)
    {
        // Desencriptar el ID si es necesario
        $id_decrypted = Crypt::decryptString($id);

        // Obtener la reunión y el asistente según los ID proporcionados
        $reureunion = ReuReunion::findOrFail($id_decrypted);
        $asistente = ReuAsistentes::find($asistenteId);

        // Renderizar la vista con los datos necesarios
        return Inertia::render('Asistencias/Form', compact('reureunion', 'asistente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * The store function in PHP validates and stores attendee information for a meeting, checking for
     * duplicate entries and ensuring the meeting is still active.
     *
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request made to the server. It contains all the data and information sent by
     * the client in the request.
     * @return a redirect back to the previous page with a success message if the asistente is
     * registered successfully. If there are any errors, it will return back to the previous page with
     * an error message.
     */
    public function store(Request $request)
    {
        // dd($request);

        $validateData = $request->validate([
            'identificacion' => 'required|numeric',
            'name' => 'required|max:150',
            'email' => 'required|email|max:150',
            'firma' => 'required|string',
            'reureunion_id' => 'required|exists:reureuniones,id',
        ]);
        try {
            // //? Validación del estado de la reunión
            $reureunion = ReuReunion::findOrFail($request->reureunion_id);
            // dd($reureunion);

            if (! $reureunion->activo) {
                return back()->withErrors(['message' => 'La reunión está cerrada.']);
            }

            //? Validamos que el asistente se encuentre en la reunión
            $asistencia = ReuAsistentes::firstOrNew([
                ['reureunion_id', $request->reureunion_id],
                ['identificacion', $request->identificacion],
            ]);

            $empleado =  getEmpleado($request->identificacion);

            //? Validamos si se encuentra repetido o no en el registro
            $asistencia->name = $empleado['APELLIDOS_NOMBRES'] ?? $validateData['name'];
            $asistencia->email =  $empleado['EMAIL_CORP'] ?? $validateData['email'];
            $asistencia->gerencia = $empleado['GERENCIA'] ?? null;
            $asistencia->cargo = $empleado['CARGO'] ?? null;
            $asistencia->firma = $validateData['firma'];

            $asistencia->save();

            return back()->with('success', 'Asistente registrado correctamente.');
            //TODO redirect view
        } catch (Exception $e) {
            return back()->withErrors('error', 'Servicio no disponible.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReuAsistentes $reuasistente)
    {
        $reuasistente->delete();
    }

    /**
     * The function "getAsistentesVue" returns a JSON response containing the attendees of a meeting.
     *
     * @param ReuReunion reureunion The parameter `` is an instance of the `ReuReunion`
     * model. It is passed to the `getAsistentesVue` function as an argument.
     * @return a JSON response with an array containing the "asistentes" property from the given
     * "ReuReunion" model.
     */
    public function getAsistentesVue(ReuReunion $reureunion)
    {
        $meetingAttendees = ReuReunion::with('asistentes')->find($reureunion->id);

        return response()->json(
            [
                'meeting_attendees' => $meetingAttendees->toArray(),
            ],
            200
        );
    }
}

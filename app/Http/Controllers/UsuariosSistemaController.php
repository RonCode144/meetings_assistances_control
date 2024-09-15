<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

// use Symfony\Component\HttpFoundation\Request;

class UsuariosSistemaController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users);

        if (Auth::user()->hasRole(['Super-Admin'])) {
            return Inertia::render('Dashboard', compact('users')); //también compact('users');

        } elseif (Auth::user()->hasRole(['Administrador'])) {
            return redirect(route('reuniones.index'));
        } else {
            Auth::user()->hasRole(['Usuario']);

            return Inertia::render('Reuniones/ErrorPermisos');
        }
    }

    public function edit(User $users)
    {
        return Inertia::render('Reuniones/Index', ['users' => $users]);
    }

    public function update($idUser, Request $request)
    {
        // Obtén los roles por nombres
        $user = User::find($idUser);
        $rol = Role::where('id', $request->rol)->first();

        $user->syncRoles($rol->name);

        return back()->with(['message' => 'Roles asignados correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // dd($user);
        $user->delete();
    }

    public function getRolesVue()
    {
        $roles = Role::all();

        return response()->json([
            'roles' => $roles,
        ], 200);
    }

    public function errorPermisos()
    {
        return Inertia::render('Reuniones/ErrorPermisos');
    }
}

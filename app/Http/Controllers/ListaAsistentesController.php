<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ListaAsistentesController extends Controller
{
    public function index()
    {
        $empleados = ApiUsuariosCotecmar::apiUsuariosCotecmar();

        return Inertia::render('Reuniones/ListaAsistentes', compact('empleados'));
    }
}

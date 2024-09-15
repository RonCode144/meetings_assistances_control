<?php

//region Importaciones de Librerías

use App\Http\Controllers\ApiPersonalSapController;
use App\Http\Controllers\ListaAsistentesController;
use App\Http\Controllers\ReuAsistentesController;
use App\Http\Controllers\ReuReunionesController;
use App\Http\Controllers\UsuariosSistemaController;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//endregion

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // 'admin',
])->group(function () {

    Route::get('/dashboard', [UsuariosSistemaController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['role:Administrador|Super-Admin']], function () {
        Route::resource('reuniones', ReuReunionesController::class);
    });

    Route::get(
        'getAsistentes/{reureunion}',
        [ReuAsistentesController::class, 'getAsistentesVue']
    )->name('getAsistentesVue');

    Route::delete('eliminarAsistente/{reuasistente}', [ReuAsistentesController::class, 'destroy'])->name('eliminarAsistente');
});

//Rutas de Manipulación de datos de los Asistentes de las reuniones
Route::get('/asistencia/{id}/{asistenteId}', [ReuAsistentesController::class, 'create'])->name('asistencia.create');
Route::get('/asistencia/registro-completo', [ReuAsistentesController::class, 'registrationComplete'])->name('asistencia.completed');
Route::post('/asistencia', [ReuAsistentesController::class, 'store'])->name('asistencia.store');

//Rutas de Control de Usuarios
Route::post('/agregarUsuariosAReunion/{id}', [ReuReunionesController::class, 'agregarUsuariosAReunion'])->name('reuniones.agregarUsuariosAReunion');
Route::post('/postUsuarios/{id}', [UsuariosSistemaController::class, 'update'])->name('usuarios.update');
Route::delete('/deleteUsuariosDashboard/{user}', [UsuariosSistemaController::class, 'destroy'])->name('usuarios.destroy');

//Rutas de Permisos de Usuario
Route::get('/getRolesVue', [UsuariosSistemaController::class, 'getRolesVue'])->name('getRolesVue');

//Ruta Support View para quienes ingresen sin rol
Route::get('/error-permisos', [UsuariosSistemaController::class, 'errorPermisos'])->name('errorPermisos');

//!Ruta Lista Asistentes Vue (Eliminar)
Route::get('/listaAsistentes', [ListaAsistentesController::class, 'index']);

//#region Control de Rutas de Apis
//Rutaa de gestión de la Api de Empleados de Cotecmar (Datos SAP)
Route::get('/apiPersonalSapCotecmar', [ApiPersonalSapController::class, 'apiPersonalSapCotecmar'])->name('apiPersonalSapCotecmar');
Route::delete('/eliminarUsuariosDeReunion/{id}', [ReuReunionesController::class, 'eliminarUsuariosDeReunion'])->name('reuniones.eliminarUsuariosDeReunion');
//endregion

//Generar PDF de Asistentes
Route::get('/lista-asistentes/{id}', [ReuReunionesController::class, 'generateAsistantsListPDF'])->name('generateAsistantsListPDF');

// Route::get('asignarRol', function () {
//     $user = User::where('username', 'ecantillo')->first();
//     $user->assignRole('Super-Admin');
// });

// Route::get('asignarRol', function () {
//     $user = User::where('username', 'rgutierrez')->first();
//     $user->assignRole('Super-Admin');
// });

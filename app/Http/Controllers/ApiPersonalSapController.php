<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http; //Necesario para uso de métodos GET, POST, PUT, DELETE

class ApiPersonalSapController extends Controller
{
    public static function apiPersonalSapCotecmar()
    {
        try {
            $login = Http::acceptJson()
                ->post(
                    //?👇 Énlace guardado como API_ENDPOINT en archivo .env
                    'https://servicioapi.cotecmar.com/auth/login',
                    [
                        'username' => 'portalreuniones',
                        'password' => 'cG9ydGFscmV1bmlvbmVz',
                    ]
                )->json();
            if ($login['status'] == 'true') {
                return Http::acceptJson()->withToken($login['token'])
                    ->get(
                        'https://servicioapi.cotecmar.com/listado_personal_sap_activos_busqueda'
                    )->json();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        // return Employee::all();
    }
}

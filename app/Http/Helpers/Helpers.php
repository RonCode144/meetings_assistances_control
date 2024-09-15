<?php

// Helper de la api Gerencias

use Illuminate\Support\Facades\Http;

function gerenciasHelper()
{
    return Cotecmar\Servicio\Main::gerencias();
}

function apiAuthEmpleadosCotecmarHelper()
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
        // throw $th;
    }
}

function getEmpleado($identificacion){
    return collect(apiAuthEmpleadosCotecmarHelper())->filter(function ($empleado) use ($identificacion) {
        return $empleado['IDENTIFICACION'] == $identificacion;
    })->first();
}

<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        if ($request->user()->hasRole('Super-Admin')) {
            return redirect(route('dashboard'));
        } elseif ($request->user()->hasRole('Administrador')) {
            return redirect(route('reuniones.index'));
        }

        return redirect(route('errorPermisos'));
    }
}

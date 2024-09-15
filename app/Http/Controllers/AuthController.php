<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = User::where('username', $request->username)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Usuario logueado satisfactoriamente',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Error en usuario o contraseña ',
            ], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }
}

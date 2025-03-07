<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Usuário Autenticado'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Credenciais inválidas. Verifique seu e-mail e senha e tente novamente.'
        ], Response::HTTP_UNAUTHORIZED);
    }
}

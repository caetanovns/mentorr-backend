<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SanctumCustomAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado usando Sanctum
        if (Auth::guard('sanctum')->check()) {
            return $next($request);
        }

        // Se não estiver autenticado, retorna 401 Unauthorized
        return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }
}

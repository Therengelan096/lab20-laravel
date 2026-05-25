<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- ¡ESTA LÍNEA ES CLAVE!
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario no está logueado o no es administrador, lo mandamos a su perfil común
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('user.profile');
        }

        return $next($request);
    }
}
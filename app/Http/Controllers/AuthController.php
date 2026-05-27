<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- 1. IMPORTANTE: Agrega esta facada aquí arriba

class AuthController extends Controller
{
    // Mostrar el formulario de Login directo en la raíz
    public function showLogin() {
        // 2. BLINDAJE: Forzar un pulso real a Aiven cada vez que el bot visite el login
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            // Si Aiven tarda en responder, atrapamos el error para no colgar la página
        }

        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.users.index') 
                : redirect()->route('user.profile');
        }
        return view('auth.login');
    }

    // Procesar el inicio de sesión manual
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string', 
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.users.index');
            }
            return redirect()->route('user.profile');
        }

        return back()->withErrors(['error' => 'Usuario o contraseña incorrectos.']);
    }

    // Cerrar sesión de manera segura
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
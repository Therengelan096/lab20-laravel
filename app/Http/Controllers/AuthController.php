<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de Login directo en la raíz
    public function showLogin() {
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
            'email' => 'required|string', // Aquí el usuario ingresará su username (ej: anderson)
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // CORREGIDO: Redirección inteligente al iniciar sesión usando el nombre correcto
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.users.index');
            }
            return redirect()->route('user.profile');
        }

        // Si las credenciales fallan, regresa al login con un mensaje de error
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
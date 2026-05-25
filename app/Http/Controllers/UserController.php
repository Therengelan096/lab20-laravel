<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        // Tomamos los datos del usuario que inició sesión actualmente
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 1. LEER (Listar todos los usuarios en el Panel)
    public function index() {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // 2. CREAR (Guardar un nuevo usuario con la nueva estructura)
    public function store(Request $request) {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'ci'               => 'required|string|unique:users,ci',
            'email'            => 'required|string|unique:users,email', // Usado como "username"
            'password'         => 'required|string|min:4',
            'role'             => 'required|in:admin,user',
        ]);

        User::create([
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci'               => $request->ci,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'role'             => $request->role,
        ]);

        return back()->with('success', 'Usuario registrado con éxito.');
    }

    // 3. ACTUALIZAR (Modificar datos de usuario o contraseña)
    public function update(Request $request, User $user) {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            // Validamos unicidad ignorando el ID del usuario actual para que no se tranque a sí mismo
            'ci'               => 'required|string|unique:users,ci,' . $user->id,
            'email'            => 'required|string|unique:users,email,' . $user->id,
            'password'         => 'nullable|string|min:4', // Nullable: Solo si se desea cambiar
            'role'             => 'required|in:admin,user',
        ]);

        // Datos básicos a actualizar
        $data = [
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci'               => $request->ci,
            'email'            => $request->email,
            'role'             => $request->role,
        ];

        // Lógica lógica para contraseña opcional
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Usuario actualizado correctamente.');
    }

    // 4. ELIMINAR (Baja del usuario)
    public function destroy(User $user) {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propia cuenta de administrador.']);
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
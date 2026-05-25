<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\AdminMiddleware; // <-- Importamos tu middleware de admin
use Illuminate\Support\Facades\Route;

// --- RUTA RAÍZ: LOGIN DIRECTO ---
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTAS PROTEGIDAS ---
Route::middleware(['auth', PreventBackHistory::class])->group(function () {

    // Tu vista de perfil corregida (con nombre, apellidos, ci, etc.)
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');

    // GRUPO DE ADMINISTRADORES (Invocando directamente a tu AdminMiddleware)
    Route::middleware([AdminMiddleware::class])->group(function () {
        
        // 1. Leer/Listar usuarios (Sincronizado al 100% con tu botón Blade)
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        // 2. Crear usuario
        Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
        // 3. Actualizar usuario o contraseña
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update'); 
        // 4. Eliminar usuario
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
        
    });
});
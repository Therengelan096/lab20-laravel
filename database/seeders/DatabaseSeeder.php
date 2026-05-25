<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tu cuenta de Administrador principal
        User::create([
            'nombre'           => 'Anderson',
            'apellido_paterno' => 'Cutile',
            'apellido_materno' => 'Alvarez',
            'ci'               => '6876857',
            'email'            => 'anderson',
            'password'         => Hash::make('admin123'),
            'role'             => 'admin',
        ]);

        User::create([
            'nombre'           => 'Omar',
            'apellido_paterno' => 'Quispe',
            'apellido_materno' => 'Mita',
            'ci'               => '7654321',
            'email'            => 'omarqm',
            'password'         => Hash::make('Omar411*'),
            'role'             => 'user',
        ]);
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla de Usuarios modificada con los nuevos campos detallados
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // --- Nuevos campos de identificación personal ---
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable(); // Nullable por si algún usuario no tiene
            $table->string('ci')->unique();                 // Cédula de Identidad única
            
            // --- Credenciales del Sistema ---
            $table->string('email')->unique(); // Se usa para guardar el nombre de usuario (ej: omarqm, anderson)
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user'); // 'admin' o 'user'
            
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabla nativa para tokens de reseteo de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabla nativa para el manejo de sesiones en Base de Datos
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
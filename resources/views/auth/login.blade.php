<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Anderson Cutile Alvarez</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;800&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cyan-neon: #00f0ff;
            --purple-neon: #bd00ff;
            --dark-surface: #0a0a0f;
            --border-color: rgba(0, 240, 255, 0.25);
        }
        body {
            min-height: 100vh;
            font-family: "Rajdhani", sans-serif;
            background-color: #030305;
            background-image:
                linear-gradient(135deg, rgba(189, 0, 255, 0.03) 0%, transparent 50%),
                linear-gradient(315deg, rgba(0, 240, 255, 0.03) 0%, transparent 50%);
            color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .custom-container {
            background: var(--dark-surface);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            position: relative;
        }
        .custom-container::before {
            content: "";
            position: absolute;
            top: -1px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--cyan-neon), var(--purple-neon), transparent);
        }
        h2 {
            font-family: "Orbitron", sans-serif;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 1.6rem;
        }
        .subtitle-decor {
            color: var(--cyan-neon);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .form-label {
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            border-radius: 6px;
            padding: 12px;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }
        .form-control:focus {
            background: rgba(0, 240, 255, 0.01);
            border-color: var(--cyan-neon);
            box-shadow: 0 0 12px rgba(0, 240, 255, 0.2);
            color: #fff;
        }
        
        /* --- ESTILOS PERSONALIZADOS PARA EL BOTÓN DEL OJITO --- */
        .btn-toggle-password {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-left: none;
            color: #94a3b8;
            padding: 0 16px;
            transition: all 0.25s ease;
        }
        .input-group:focus-within .form-control {
            border-color: var(--cyan-neon);
        }
        .input-group:focus-within .btn-toggle-password {
            border-color: var(--cyan-neon);
            color: var(--cyan-neon);
            box-shadow: 0 0 12px rgba(0, 240, 255, 0.1);
        }
        .btn-toggle-password:hover {
            color: #ffffff;
            background: rgba(0, 240, 255, 0.05);
        }
        .input-group .form-control {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        .input-group .btn-toggle-password {
            border-top-right-radius: 6px !important;
            border-bottom-right-radius: 6px !important;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #00b4d8, #0077b6);
            border: none;
            color: #fff;
            font-family: "Orbitron", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 1px;
            border-radius: 6px;
            transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.2);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.4);
            background: linear-gradient(90deg, #00f0ff, #00b4d8);
            color: #000;
        }
        .alert-custom {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #f87171;
            font-size: 0.9rem;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="custom-container">
        <div class="text-center mb-4">
            <h2>Acceso al Sistema</h2>
            <span class="subtitle-decor">Estudiante: Anderson Cutile Alvarez</span>
        </div>

        @if($errors->any())
            <div class="alert alert-custom text-center p-2 mb-3 fw-bold animate__animated animate__shakeX">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario / Correo</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border: 1px solid rgba(255, 255, 255, 0.08); color: #64748b;">
                        <i class="bi bi-person-cyber"></i>
                    </span>
                    <input type="text" name="email" class="form-control border-start-0" placeholder="username" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Contraseña de Acceso</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border: 1px solid rgba(255, 255, 255, 0.08); color: #64748b;">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" required autocomplete="current-password">
                    <button type="button" id="togglePassword" class="btn btn-toggle-password">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="bi bi-shield-lock-fill"></i> Iniciar Sesión
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html>
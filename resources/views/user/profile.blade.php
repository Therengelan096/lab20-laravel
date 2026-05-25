<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - ACA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;800&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --cyan-neon: #00f0ff;
            --purple-neon: #bd00ff;
            --dark-surface: #0a0a0f;
            --border-color: rgba(189, 0, 255, 0.25);
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
            max-width: 480px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            position: relative;
            text-align: center;
        }
        .custom-container::before {
            content: "";
            position: absolute;
            top: -1px;
            left: 15%;
            right: 15%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--purple-neon), var(--cyan-neon), transparent);
        }
        .avatar-glow {
            width: 80px;
            height: 80px;
            border: 2px solid var(--purple-neon);
            box-shadow: 0 0 15px rgba(189, 0, 255, 0.4);
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            color: #fff;
        }
        h2 {
            font-family: "Orbitron", sans-serif;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 1.5rem;
        }
        .profile-field {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .field-icon {
            font-size: 1.4rem;
            color: var(--purple-neon);
        }
        .field-content {
            flex: 1;
        }
        .field-label {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 2px;
        }
        .field-value {
            color: #f1f5f9;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .btn-cyber-nav {
            display: block;
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1px solid rgba(0, 240, 255, 0.3);
            color: var(--cyan-neon);
            font-family: "Orbitron", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s ease;
            margin-bottom: 12px;
        }
        .btn-cyber-nav:hover {
            background: rgba(0, 240, 255, 0.1);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 240, 255, 0.3);
        }
        .btn-logout {
            width: 100%;
            padding: 12px;
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #f87171;
            font-family: "Orbitron", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            border-radius: 6px;
            transition: 0.3s ease;
        }
        .btn-logout:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
        }
    </style>
</head>
<body>
    <div class="custom-container">
        <div class="d-flex justify-content-center mb-3">
            <div class="avatar-glow rounded-circle d-flex align-items-center justify-content-center bg-transparent">
                {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
            </div>
        </div>

        <h2>Perfil Autorizado</h2>
        <p class="small mb-4 text-uppercase tracking-wider" style="font-size: 0.75rem; color: var(--cyan-neon);">
            <i class="bi bi-cpu"></i> Terminal de Usuario Activa
        </p>

        <div class="text-start d-flex flex-column gap-3 mb-4">
            
            <div class="profile-field">
                <div class="field-icon"><i class="bi bi-person-fill-check"></i></div>
                <div class="field-content">
                    <span class="field-label">Nombre Completo</span>
                    <span class="field-value">
                        {{ auth()->user()->nombre }} {{ auth()->user()->apellido_paterno }} {{ auth()->user()->apellido_materno }}
                    </span>
                </div>
            </div>

            <div class="profile-field">
                <div class="field-icon" style="color: var(--purple-neon);"><i class="bi bi-card-text-fill"></i></div>
                <div class="field-content">
                    <span class="field-label">Cédula de Identidad (CI)</span>
                    <span class="field-value">{{ auth()->user()->ci }}</span>
                </div>
            </div>
            
            <div class="profile-field">
                <div class="field-icon" style="color: var(--cyan-neon);"><i class="bi bi-shield-lock-fill"></i></div>
                <div class="field-content">
                    <span class="field-label">Identificador de Acceso</span>
                    <span class="field-value" style="color: var(--cyan-neon); font-family: monospace;">{{ auth()->user()->email }}</span>
                </div>
            </div>
            
            <div class="profile-field">
                <div class="field-icon"><i class="bi bi-tags-fill"></i></div>
                <div class="field-content">
                    <span class="field-label">Rango Asignado</span>
                    <span class="badge text-uppercase mt-1" style="background: rgba(189, 0, 255, 0.15); color: #e879f9; border: 1px solid rgba(189, 0, 255, 0.3); padding: 5px 12px; font-size: 0.75rem; font-family: 'Orbitron', sans-serif;">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>

        </div>

        @if(auth()->user()->role === 'admin')
            <div class="mb-3">
                <a href="{{ route('admin.users.index') }}" class="btn-cyber-nav">
                    <i class="bi bi-speedometer2"></i> Regresar al Dashboard
                </a>
            </div>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-power"></i> Cerrar Sesión
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
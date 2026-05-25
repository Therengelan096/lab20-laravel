<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador (ABM) - ACA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;800&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            padding: 40px 20px;
        }
        .custom-container {
            background: var(--dark-surface);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 35px;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            position: relative;
        }
        .custom-container::before {
            content: "";
            position: absolute;
            top: -1px;
            left: 5%;
            right: 5%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--cyan-neon), var(--purple-neon), transparent);
        }
        h2, h5, .modal-title {
            font-family: "Orbitron", sans-serif;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .subtitle-decor {
            color: var(--purple-neon);
            text-shadow: 0 0 8px rgba(189, 0, 255, 0.4);
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .form-label {
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            border-radius: 6px;
            padding: 10px;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(0, 240, 255, 0.01);
            border-color: var(--cyan-neon);
            box-shadow: 0 0 10px rgba(0, 240, 255, 0.2);
            color: #fff;
        }
        .form-select option {
            background-color: #0f0f15;
            color: #fff;
        }
        .btn-submit {
            padding: 10px 20px;
            background: linear-gradient(90deg, #00b4d8, #0077b6);
            border: none;
            color: #fff;
            font-family: "Orbitron", sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-radius: 6px;
            transition: 0.3s ease;
        }
        .btn-submit:hover {
            background: linear-gradient(90deg, #00f0ff, #00b4d8);
            color: #000;
            box-shadow: 0 0 12px var(--cyan-neon);
        }
        .btn-logout {
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #f87171;
            font-family: "Orbitron", sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 0 10px #ef4444;
        }
        .table-custom {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .table-custom th {
            background: rgba(189, 0, 255, 0.1) !important;
            color: #fff;
            font-family: "Orbitron", sans-serif;
            font-size: 0.8rem;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(189, 0, 255, 0.3);
            padding: 12px;
        }
        .table-custom td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            background: transparent !important;
            color: #e2e8f0 !important;
        }
        .badge-admin {
            background: rgba(189, 0, 255, 0.15);
            color: #e0aaff;
            border: 1px solid rgba(189, 0, 255, 0.3);
            padding: 4px 8px;
        }
        .badge-user {
            background: rgba(0, 240, 255, 0.1);
            color: #a5f3fc;
            border: 1px solid rgba(0, 240, 255, 0.2);
            padding: 4px 8px;
        }
        .swal2-popup {
            background: #0f0f15 !important;
            border: 1px solid rgba(0, 240, 255, 0.2) !important;
            color: #fff !important;
            font-family: "Rajdhani", sans-serif !important;
        }
        /* --- ESTILOS ADICIONALES PARA EL MODAL CYBER --- */
        .modal-content {
            background: #0f0f16;
            border: 1px solid var(--cyan-neon);
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.15);
        }
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>
    <div class="custom-container">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-10">
            <div>
                <h2>Panel de Control (ABM)</h2>
                <span class="subtitle-decor">Administrador: {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>

        @if($errors->any())
            <div class="alert alert-danger bg-danger bg-opacity-10 border-danger text-danger p-2 mb-4 font-monospace text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-5 p-4 rounded" style="background: rgba(255,255,255,0.01); border: 1px solid rgba(255,255,255,0.03);">
            <h5 class="mb-4 text-white text-uppercase" style="font-size: 1rem; letter-spacing: 1px; color: var(--cyan-neon) !important;">Registrar Nuevo Usuario</h5>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan" required autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ap. Paterno</label>
                        <input type="text" name="apellido_paterno" class="form-control" placeholder="Ej: Perez" required autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ap. Materno</label>
                        <input type="text" name="apellido_materno" class="form-control" placeholder="Ej: Gomez" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Cédula (CI)</label>
                        <input type="text" name="ci" class="form-control" placeholder="Ej: 123456" required autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Username (Login)</label>
                        <input type="text" name="email" class="form-control" placeholder="Ej: juanp" required autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Mínimo 4 carac." required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Rol Asignado</label>
                        <select name="role" class="form-select">
                            <option value="user" selected>user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-submit w-100">Crear</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle m-0">
                <thead>
                    <tr>
                        <th style="width: 110px;">CI</th>
                        <th>Nombre Completo</th>
                        <th>Identificador Web (Username)</th>
                        <th>Rango / Rol</th>
                        <th class="text-center" style="width: 180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td class="fw-bold font-monospace text-info ps-3">{{ $u->ci }}</td>
                        <td class="text-white fw-semibold">{{ $u->nombre }} {{ $u->apellido_paterno }} {{ $u->apellido_materno }}</td>
                        <td><code style="color: var(--cyan-neon); font-size: 0.95rem;">{{ $u->email }}</code></td>
                        <td>
                            <span class="badge {{ $u->role == 'admin' ? 'badge-admin' : 'badge-user' }} text-uppercase">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-warning fw-bold me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $u->id }}">
                                Editar
                            </button>
                            
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-submit fw-bold">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-start">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size: 1.1rem; color: var(--cyan-neon);"><i class="bi bi-pencil-square"></i> Actualizar Registro</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.users.update', $u->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $u->nombre }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Ap. Paterno</label>
                                                <input type="text" name="apellido_paterno" class="form-control" value="{{ $u->apellido_paterno }}" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Ap. Materno</label>
                                                <input type="text" name="apellido_materno" class="form-control" value="{{ $u->apellido_materno }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">CI</label>
                                            <input type="text" name="ci" class="form-control" value="{{ $u->ci }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Username (Login)</label>
                                            <input type="text" name="email" class="form-control" value="{{ $u->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" style="color: #fbbf24;">Nueva Contraseña (Opcional)</label>
                                            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para conservar actual">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Rol</label>
                                            <select name="role" class="form-select" required>
                                                <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>user</option>
                                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary font-monospace fw-bold" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-sm btn-info text-dark fw-bold font-monospace">Aplicar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                title: "OPERACIÓN EXITOSA",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#00f0ff"
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-delete-submit').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-delete');
                Swal.fire({
                    title: "¿Remover Usuario?",
                    text: "Esta acción destruirá el registro de forma permanente.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ef4444",
                    cancelButtonColor: "#94a3b8",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
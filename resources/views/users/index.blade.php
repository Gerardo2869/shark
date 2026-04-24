<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --border-color: #d2d2d7;
            --input-bg: #f5f5f7;
            --primary-color: #0071e3;
            --primary-hover: #0077ed;
            --focus-ring: rgba(0, 113, 227, 0.4);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 40px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 18px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 1300px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.015em;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            background-color: var(--primary-color);
            text-decoration: none;
            border-radius: 12px;
            transition: background-color 0.2s ease;
        }

        .add-btn:hover {
            background-color: var(--primary-hover);
        }

        .edit-btn {
            display: inline-block;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--primary-color);
            background-color: var(--bg-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .edit-btn:hover {
            background-color: #e5f0fa;
        }

        .search-container {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .search-form {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .search-group {
            flex: 1;
            min-width: 150px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .search-input {
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
            width: 100%;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .search-actions {
            display: flex;
            gap: 10px;
        }

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }

        .pagination-wrapper .flex.justify-between.flex-1.sm\:hidden {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .pagination-wrapper .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-wrapper p.text-sm.text-gray-700 {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0;
        }

        .pagination-wrapper a,
        .pagination-wrapper span.relative.inline-flex.items-center,
        .pagination-wrapper span[aria-current="page"]>span,
        .pagination-wrapper span[aria-disabled="true"]>span {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .pagination-wrapper a:hover {
            background-color: var(--bg-color);
        }

        .pagination-wrapper span[aria-current="page"]>span {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
            z-index: 1;
        }

        .pagination-wrapper span[aria-disabled="true"]>span {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: var(--bg-color);
        }

        .pagination-wrapper svg {
            width: 16px;
            height: 16px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px {
            display: flex;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>* {
            margin-left: -1px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>*:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>*:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        th {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 14px;
            padding: 16px;
            border-bottom: 1px solid #eaeaea;
            color: var(--text-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-admin {
            background-color: #e5f0fa;
            color: #0071e3;
        }

        .status-normal {
            background-color: #f5f5f7;
            color: #1d1d1f;
        }

        /* Apple SweetAlert Style */
        div.swal2-popup {
            border-radius: 18px !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
        }

        button.swal2-confirm,
        button.swal2-cancel {
            border-radius: 12px !important;
            padding: 12px 24px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
        }

        .swal2-html-container-form {
            margin: 1em 0 0 0 !important;
            overflow: visible !important;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
            flex: 1;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            font-family: inherit;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
            appearance: none;
        }

        .form-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2386868b' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .swal-submit-btn {
            width: 100%;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 12px;
        }

        .swal-submit-btn:hover {
            background-color: var(--primary-hover);
        }

        .swal-submit-btn:active {
            transform: scale(0.98);
        }

        .search-main-row {
            display: flex;
            gap: 16px;
            width: 100%;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #fafafc;
        }

        .pill-btn {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <h1>Gestión de Usuarios</h1>
                <a href="{{ url('/sales') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                        <path d="M3 6h18" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    Ir a Ventas
                </a>
                <a href="{{ url('/paints') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Volver a Pinturas
                </a>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <button type="button" class="add-btn" onclick="openCreateModal()"
                    style="border: none; cursor: pointer;">Nuevo Usuario</button>
                <a href="{{ route('profile.edit') }}" class="edit-btn"
                    style="border: none; cursor: pointer; color: var(--text-color);">Mi Perfil</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="edit-btn" style="border: none; cursor: pointer; color: #d93d3b;">Cerrar
                        Sesión</button>
                </form>
            </div>
        </div>

        @if($errors->any())
            <div
                style="background-color: #fceceb; border: 1px solid #fecaca; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px;">
                <h4 style="margin: 0 0 8px 0; color: #b91c1c; font-size: 14px; font-weight: 600;">Hubo algunos problemas:
                </h4>
                <ul style="margin: 0; color: #dc2626; font-size: 14px; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="search-container">
            <form action="{{ route('users.index') }}" method="GET" class="search-form">
                <div class="search-main-row">
                    <div class="search-group" style="flex: 2; min-width: 250px;">
                        <label for="search" style="display: none;">Buscar</label>
                        <input type="text" id="search" name="search" class="search-input"
                            placeholder="Buscar por nombre o correo..." value="{{ request('search') }}"
                            style="padding: 14px 18px; border-radius: 12px; font-size: 15px;">
                    </div>
                    <div class="search-actions" style="display: flex; align-items: center; gap: 12px;">
                        <button type="submit" class="add-btn pill-btn">Buscar</button>
                        @if(request()->anyFilled(['search']))
                            <a href="{{ route('users.index') }}" class="edit-btn pill-btn"
                                style="text-decoration: none; border: 1px solid var(--border-color); display: flex; align-items: center; height: 100%;">Limpiar</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th>Fecha de Creación</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="status-badge status-admin">Administrador</span>
                                @else
                                    <span class="status-badge status-normal">Normal</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td style="text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <button type="button" class="edit-btn" onclick="openEditModal({{ $user->toJson() }})"
                                        style="border: none; cursor: pointer; color: var(--primary-color);">Editar</button>
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="margin: 0;"
                                            onsubmit="return confirmDelete(event, this)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="edit-btn"
                                                style="border: none; cursor: pointer; color: #d93d3b;">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: '¡Completado!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#0071e3'
            });
        @endif

            function getFormHtml(user = null) {
                const isEdit = user !== null;
                const actionUrl = isEdit ? `/users/${user.id}` : '/users';
                const methodField = isEdit ? '@method("PUT")' : '';
                const titleText = isEdit ? 'Actualizar Usuario' : 'Crear Usuario';

                const name = isEdit ? user.name : '';
                const email = isEdit ? user.email : '';
                const role = isEdit ? user.role : 'user';

                const pwdPlaceholder = isEdit ? 'Dejar en blanco para no cambiar' : 'Mínimo 8 caracteres';
                const pwdRequired = isEdit ? '' : 'required';

                return `
            <form method="POST" action="${actionUrl}" id="userForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                ${methodField}
                
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" name="name" type="text" value="${name}" placeholder="Ej. Juan Pérez" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" name="email" type="email" value="${email}" placeholder="Ej. juan@ejemplo.com" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" name="password" type="text" placeholder="${pwdPlaceholder}" minlength="8" ${pwdRequired}>
                    </div>

                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select id="role" name="role" required>
                            <option value="user" ${role === 'user' ? 'selected' : ''}>Normal</option>
                            <option value="admin" ${role === 'admin' ? 'selected' : ''}>Administrador</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="swal-submit-btn">${titleText}</button>
            </form>
            `;
            }

        function openCreateModal() {
            Swal.fire({
                title: 'Nuevo Usuario',
                html: getFormHtml(),
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-popup',
                    htmlContainer: 'swal2-html-container-form'
                }
            });
        }

        function openEditModal(user) {
            Swal.fire({
                title: 'Editar Usuario',
                html: getFormHtml(user),
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-popup',
                    htmlContainer: 'swal2-html-container-form'
                }
            });
        }

        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto. El usuario será eliminado.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93d3b',
                cancelButtonColor: '#86868b',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</body>

</html>
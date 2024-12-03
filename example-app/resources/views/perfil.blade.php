<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Perfil de Usuario</title>
    @vite(['resources/css/perfil.css'])
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <button class="toggle-btn" aria-label="Abrir menú">
            <img src="{{ asset('images/Menu.svg') }}" width="30" height="30" alt="Menú">
        </button>
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Menú Lateral  -->
    <div class="sidebar active">
        <div class="logo">Perfil</div>
        <ul>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Car.svg') }}" width="20" height="20" alt="Carros">
                <span>Registro de Carros</span>
            </li>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Moto.svg') }}" width="20" height="20" alt="Motos">
                <span>Registro de Motos</span>
            </li>
            <li onclick="window.location.href='{{ route('registro.bicicletas') }}'">
                <img src="{{ asset('images/bici.svg') }}" width="20" height="20" alt="Bicicletas">
                <span>Registro de Bicicletas</span>
            </li>
            <li onclick="window.location.href='{{ route('menu') }}'">
                <img src="{{ asset('images/Home.svg') }}" width="20" height="20" alt="Menú">
                <span>Regresar al Menú</span>
            </li>
            <li class="salir">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <img src="{{ asset('images/power.svg') }}" width="20" height="20" alt="Cerrar sesión">
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="perfil-container">
            <div class="titulo">Perfil de Usuario</div>

            <!-- Div para mensajes -->
            <div id="mensaje"></div>

            <!-- Formulario de Perfil -->
            <form id="perfilForm" action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Foto de Perfil -->
                <div class="form-group">
                    <label for="nuevoFotoPerfil">Foto de Perfil:</label>
                    <input type="file" id="nuevoFotoPerfil" name="nuevoFotoPerfil" accept="image/*" onchange="mostrarVistaPrevia(this)">
                    <!-- Mostrar la imagen de perfil -->
                    <img id="previewPerfil" 
                        class="image-preview" 
                        alt="Todavía no ha cargado una foto de perfil, por favor sube una y guardala."
                        src="{{ $user->fotoUsuario ? asset('image/perfil/' . $user->fotoUsuario) : asset('images/default-avatar.png') }}">
                </div>
                <!-- Íconos para Eliminar y Guardar -->
                <div class="buttons">
                    <!-- Botón de Eliminar -->
                    <button 
                        type="button"
                        class="icon reset-icon" 
                        title="Eliminar" 
                        onclick="resetForm()"
                        aria-label="Eliminar"
                        onkeypress="handleKeyPress(event, resetForm)"
                    >
                        <img src="{{ asset('images/delete.svg') }}" alt="Eliminar">
                    </button>

                    <!-- Botón de Guardar -->
                    <button 
                        type="submit"
                        class="icon submit-icon" 
                        title="Guardar" 
                        aria-label="Guardar"
                        onkeypress="handleKeyPress(event, submitForm)"
                    >
                        <img src="{{ asset('images/Save.svg') }}" alt="Guardar">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function mostrarMantenimiento() {
            Swal.fire({
                icon: 'info',
                title: 'Página en mantenimiento',
                text: 'Esta página está en mantenimiento, por favor intenta más tarde.',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#3085d6'
            });
        }
    </script>
</body>

</html>

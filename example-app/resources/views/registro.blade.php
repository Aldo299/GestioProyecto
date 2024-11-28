<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    @vite(['resources/css/registro.css'])
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="registro-container">
            <!-- Botón de Cancelar -->
            <button class="cancel-btn" aria-label="Cancelar" onclick="window.location.href='{{ route('menu') }}'">
                <img src="{{ asset('images/cancelar.svg') }}" alt="Cancelar" width="40" height="40">
            </button>

            <div class="titulo">Registro de Usuario</div>
            <form id="registroForm" action="{{ route('registro.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Usuario -->
                <div class="form-group">
                    <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                    @error('usuario')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Número de Control -->
                <div class="form-group">
                    <input type="text" id="numeroControl" name="numeroControl" placeholder="Ingresa tu Número de Control" required>
                    @error('numeroControl')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group">
                    <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo electrónico institucional" required>
                    @error('correo')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Contraseña -->
                <div class="form-group">
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
                    @error('contrasena')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Foto de Perfil (Opcional) -->
                <div class="form-group">
                    <label for="fotoPerfil">Foto de Perfil (Opcional):</label>
                    <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*" onchange="mostrarVistaPrevia(this)">
                    <img id="preview_bici" class="image-preview" alt="Vista Previa de la Imagen">
                </div>



                <!-- Botón para Registrar Usuario -->
                <div class="form-group">
                    <button type="submit" class="boton boton-verificar">Registrar Usuario</button>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/registro.js') }}"></script>
</body>

</html>

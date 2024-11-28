<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecer Contraseña</title>
    @vite(['resources/css/establecer_contraseña.css'])
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="password-container">
            <div class="titulo">Establecer Contraseña</div>
            <form id="passwordForm" action="{{ route('password.store') }}" method="POST">
                @csrf
                <!-- Contraseña -->
                <div class="form-group">
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
                    @error('contrasena')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <input type="password" id="confirmarContrasena" name="confirmarContrasena" placeholder="Confirma tu contraseña" required>
                    @error('confirmarContrasena')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="botones">
                    <a href="{{ route('inicio') }}" class="boton-cancelar">Cancelar</a>
                    <button type="submit" class="boton-guardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/establecer_contrasena.js') }}"></script>
</body>

</html>

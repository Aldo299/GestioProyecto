<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    @vite(['resources/css/login.css'])
</head>

<body>
    <!-- Barra de Encabezado -->
    <div class="header">
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo" class="logo2">
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="login-container">
            <div class="titulo">Inicio de Sesión</div>
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                <!-- No Control (cambio de 'usuario' a 'no_control') -->
                <div class="form-group">
                    <label for="no_control">No. Control</label>
                    <input type="text" id="no_control" name="no_control" placeholder="Ingresa tu no. de control" value="{{ old('no_control') }}" required>
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
                </div>

                <!-- Botones -->
                <div class="botones">
                    <a href="{{ route('registro') }}" class="boton-registrarse">Registrarse</a>
                    <button type="submit" class="boton-login">Iniciar Sesión</button>
                </div>

                <!-- Mensajes de error -->
                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>

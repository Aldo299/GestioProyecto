<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    @vite(['resources/css/restablecer_contraseña.css'])
</head>

<body>
    <!-- Barra de Encabezado -->
    <div class="header">
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="reset-container">
            <div class="acciones">
                <!-- Botón de Eliminar -->
                <button 
                    type="button" 
                    class="icon cancelar-icon" 
                    onclick="cancelarAccion()"
                    aria-label="Cancelar"
                    onkeypress="handleKeyPress(event, cancelarAccion)"
                >
                    <img src="{{ asset('images/cancelar.svg') }}" alt="Cancelar">
                </button>
            </div>

            <!-- Título del Formulario -->
            <div class="titulo">Restablecer Contraseña</div>
            <form id="resetForm" action="{{ route('password.update') }}" method="POST">
                @csrf
                <!-- Solicitud de Restablecimiento -->
                <div class="form-group" id="campoSolicitud">
                    <label for="correo"></label>
                    <input type="email" id="correo" name="email" placeholder="Ingresa tu correo electrónico" required>
                    <div id="errorCorreo" class="error-message"></div>
                    <button type="button" class="boton-enviar" onclick="enviarCodigo(event)">Enviar Solicitud</button>
                </div>

                <!-- Verificación del Código -->
                <div class="form-group campo-verificacion" id="campoCodigo">
                    <label for="codigoIngresado">Ingresa el Código de Verificación:</label>
                    <input type="text" id="codigoIngresado" name="codigo" placeholder="Ingresa el código recibido" required>
                    <div id="errorCodigo" class="error-message"></div>
                    <button type="button" class="boton-enviar" onclick="verificarCodigo(event)">Verificar Código</button>
                </div>

                <!-- Establecer Nueva Contraseña -->
                <div class="form-group campo-verificacion" id="campoNuevaContrasena">
                    <label for="nuevaContrasena">Nueva Contraseña:</label>
                    <input type="password" id="nuevaContrasena" name="password" placeholder="Ingresa tu nueva contraseña" required>
                    <div id="errorNuevaContrasena" class="error-message"></div>
                </div>

                <div class="form-group campo-verificacion" id="campoConfirmarContrasena">
                    <label for="confirmarContrasena">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="confirmarContrasena" name="password_confirmation" placeholder="Confirma tu nueva contraseña" required>
                    <div id="errorConfirmarContrasena" class="error-message"></div>
                    <button type="submit" class="boton-guardar">Guardar Nueva Contraseña</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/reset_password.js') }}"></script>
</body>

</html>

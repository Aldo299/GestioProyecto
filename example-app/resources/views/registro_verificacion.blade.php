<!-- registro_verificacion.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Usuario</title>
    @vite(['resources/css/registro.css'])
</head>
<body>

<div class="header">
    <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
    <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
</div>

<div class="content">
    <div class="registro-container">
        <div class="titulo">Verificación de Código</div>
        <form id="verificacionForm" action="{{ route('registro.verificar.submit') }}" method="POST">
            @csrf

            <!-- Campo para Ingresar el Código de Verificación -->
            <div class="form-group">
                <input type="text" id="codigoIngresado" name="codigoIngresado" placeholder="Ingresa el código recibido en tu correo" required>
                @error('codigoIngresado')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botón para Confirmar el Código -->
            <div class="form-group">
                <button type="submit" class="boton boton-confirmar">Confirmar Código</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/registro.js') }}"></script>
</body>
</html>

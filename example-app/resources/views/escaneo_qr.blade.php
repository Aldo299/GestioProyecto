<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo de Código QR</title>
    @vite(['resources/css/escaneo_qr.css'])
    <script type="module">
        import QrScanner from "https://unpkg.com/qr-scanner@1.4.2/qr-scanner.min.js";

        QrScanner.WORKER_PATH = 'https://unpkg.com/qr-scanner@1.4.2/qr-scanner-worker.min.js';

        document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById('video-preview');
        const botonEscaneo = document.getElementById('botonEscaneo');
        const resultadoNoControl = document.getElementById('noControl');
        const resultadoColor = document.getElementById('colorBici');
        const resultadoNombre = document.getElementById('nombreUsuario');
        const fotoBici = document.getElementById('fotoBici');
        const fotoEstudiante = document.getElementById('fotoEstudiante');

        let qrScanner;

        botonEscaneo.addEventListener('click', () => {
            botonEscaneo.style.display = 'none';
            iniciarEscaneo();
        });

        function iniciarEscaneo() {
            video.style.display = 'block';
            qrScanner = new QrScanner(video, result => {
                procesarResultado(result);
                qrScanner.stop();
                video.style.display = 'none';
                botonEscaneo.style.display = 'block';
            }, {
                onDecodeError: error => {
                    console.warn(`Error de decodificación: ${error}`);
                },
                highlightScanRegion: true,
                highlightCodeOutline: true
            });

            qrScanner.start();
        }

        function procesarResultado(result) {
            // El QR contiene un objeto JSON, decodificarlo
            const registro = JSON.parse(result.data); // El contenido del QR

            if (registro) {
                // Mostrar la información del usuario y la bicicleta
                resultadoNoControl.value = registro.noControl || 'N/A';
                resultadoColor.value = registro.color || 'N/A';
                resultadoNombre.value = registro.nombreUsuario || 'N/A';

                // Mostrar las fotos si existen
                if (registro.bicicleta_foto) {
                    // Si la URL de la foto de la bicicleta ya está en el QR, la mostramos
                    fotoBici.src = registro.bicicleta_foto; // URL de la foto de la bicicleta
                    fotoBici.style.display = 'block';
                } else if (registro.id_bicicleta) {
                    // Si no, construimos la URL usando el id_bicicleta
                    fotoBici.src = `http://localhost:8000/storage/bicicletas/${registro.id_bicicleta}.jpg`;
                    fotoBici.style.display = 'block';
                } else {
                    fotoBici.style.display = 'none';
                }

                // Ajustamos la URL de la foto del usuario (sin el prefijo extra)
                if (registro.usuario_foto) {
                    const usuarioFotoURL = registro.usuario_foto.replace("/perfil_images/perfil_images", "/perfil_images");
                    fotoEstudiante.src = usuarioFotoURL;
                    fotoEstudiante.style.display = 'block';
                } else {
                    fotoEstudiante.style.display = 'none';
                }
            } else {
                alert("No se pudo procesar la información del QR.");
            }
        }


        // Exponer la función salir() al objeto global window
        window.salir = function () {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                window.location.href = "Inicio.html";
            }
        };
    });

    </script>
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <button class="toggle-btn" aria-label="Abrir menú lateral">
            <img src="{{ asset('images/Menu.svg') }}" width="30" height="30" alt="Menu">
        </button>
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Menú Lateral -->
    <div class="sidebar">
        <div class="logo">Menú</div>
        <ul>
            <li onclick="window.location.href='{{ route('registro.guardia') }}'">
                <img src="{{ asset('images/historial.svg') }}" width="20" height="20" alt="Registros">
                <span>Registros</span>
            </li>
            <li class="salir" onclick="salir()">
                <img src="{{ asset('images/power.svg') }}" width="20" height="20" alt="Cerrar sesión">
                <span>Cerrar sesión</span>
            </li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="escaneo-container">
            <div class="titulo">Escaneo de Código QR</div>
            <button id="botonEscaneo" class="boton-escaneo">Iniciar Escaneo</button>
            <video id="video-preview" muted></video>

            <div class="campos-informacion">
                <div class="campo">
                    <label for="noControl">Número de Control:</label>
                    <input type="text" id="noControl" readonly>
                </div>

                <div class="campo">
                    <label for="colorBici">Color de la Bicicleta:</label>
                    <input type="text" id="colorBici" readonly>
                </div>

                <div class="campo">
                    <label for="nombreUsuario">Nombre del Usuario:</label>
                    <input type="text" id="nombreUsuario" readonly>
                </div>

                <div class="fotos">
                    <div class="foto">
                        <label>Foto de la Bicicleta:</label>
                        <img id="fotoBici" alt="Foto de la Bicicleta">
                    </div>
                    <div class="foto">
                        <label>Foto del Estudiante:</label>
                        <img id="fotoEstudiante" alt="Foto del Estudiante">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

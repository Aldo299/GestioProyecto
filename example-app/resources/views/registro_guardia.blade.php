<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Bicicletas</title>
    @vite(['resources/css/registro_guardia.css'])
    <!-- Incluir la biblioteca QRCode.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="module">
        import QrScanner from "https://unpkg.com/qr-scanner@1.4.2/qr-scanner.min.js";

        QrScanner.WORKER_PATH = 'https://unpkg.com/qr-scanner@1.4.2/qr-scanner-worker.min.js';

        document.addEventListener("DOMContentLoaded", function () {
            // Funcionalidad de la barra lateral
            const toggleBtn = document.querySelector(".toggle-btn");
            const sidebar = document.querySelector(".sidebar");

            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("active");
                // Ajustar el margen del contenido según el estado del sidebar
                if (sidebar.classList.contains("active")) {
                    document.querySelector(".content").style.marginLeft = "250px";
                } else {
                    document.querySelector(".content").style.marginLeft = "0";
                }
            });

            // Asignar el event listener al botón "Salir"
            document.querySelector('.sidebar ul li.salir').addEventListener('click', salir);
        });

        function salir() {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                window.location.href = "Inicio.html";
            }
        }

        function verCodigoQR(id) {
            window.location.href = `codigoQR.html?id=${id}`;
        }
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
            <li onclick="window.location.href='{{ route('escaneo.qr') }}'">
                <img src="{{ asset('images/sacan.svg') }}" width="20" height="20" alt="Registros">
                <span>Escaneo</span>
            </li>
            <li class="salir" onclick="salir()">
                <img src="{{ asset('images/power.svg') }}" width="20" height="20" alt="Salir">
                <span>Cerrar sesión</span>
            </li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="registro-container">
            <div class="titulo">Registros de Bicicletas</div>

            <!-- Barra de Búsqueda -->
            <div class="barra-busqueda">
                <input type="text" id="campoBusqueda" placeholder="Buscar por ID, Número de Control, etc...">
                <button id="botonBusqueda">
                    <img src="{{ asset('images/lupa.svg') }}" width="20" height="20" alt="Buscar">
                </button>
            </div>

            <table class="tabla-registros" id="tablaRegistros">
                <thead>
                    <tr>
                        <th>ID de Registro</th>
                        <th>Número de Control</th>
                        <th>ID de Bicicleta</th>
                        <th>ID Punto de Acceso</th>
                        <th>Código QR</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los registros serán renderizados dinámicamente -->
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->numero_control }}</td>
                            <td>{{ $registro->id_bicicleta }}</td>
                            <td>{{ $registro->id_punto_acceso }}</td>
                            <td>
                                <button onclick="verCodigoQR('{{ $registro->id }}')">Ver QR</button>
                            </td>
                            <td>{{ $registro->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function salir() {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                window.location.href = "{{ route('logout') }}";
            }
        }

        function verCodigoQR(id) {
            window.location.href = `{{ url('/codigoQR') }}/${id}`;
        }
    </script>
</body>

</html>

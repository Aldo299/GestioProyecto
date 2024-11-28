<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Código QR Generado</title>
    @vite(['resources/css/codigo_qr.css'])
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.querySelector(".toggle-btn");
            const sidebar = document.querySelector(".sidebar");
            const content = document.querySelector(".content");

            // Función para abrir/ocultar el menú lateral
            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("active");

                // Ajustar el margen del contenido según el estado del sidebar en escritorio
                if (window.innerWidth > 768) {
                    if (sidebar.classList.contains("active")) {
                        content.style.marginLeft = "250px";
                    } else {
                        content.style.marginLeft = "0";
                    }
                }
            });

            // Ajustar el estado del sidebar al redimensionar la ventana
            window.addEventListener("resize", () => {
                if (window.innerWidth > 768) {
                    // Asegurar que el sidebar esté activo en escritorio
                    sidebar.classList.add("active");
                    content.style.marginLeft = "250px";
                } else {
                    // Ocultar el sidebar por defecto en móviles
                    sidebar.classList.remove("active");
                    content.style.marginLeft = "0";
                }
            });

            // Inicializar el estado del sidebar basado en el tamaño de la ventana al cargar
            if (window.innerWidth > 768) {
                sidebar.classList.add("active");
                content.style.marginLeft = "250px";
            } else {
                sidebar.classList.remove("active");
                content.style.marginLeft = "0";
            }
        });

        // Función para salir del sistema
        function salir() {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                window.location.href = "Inicio.html";
            }
        }

        // Funciones específicas para esta página
        function regresar() {
            window.history.back();
        }

        function imprimirPagina() {
            window.print();
        }
    </script>
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <button class="toggle-btn" aria-label="Abrir menú lateral">
            <img src="{{ asset('images/Menu.svg') }}" width="30" height="30" alt="Menú">
        </button>
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Menú Lateral Dinámico -->
    <div class="sidebar active">
        <div class="logo">Menú</div>
        <ul>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Car.svg') }}" width="20" height="20" alt="Registro de Carros">
                <span>Registro de Carros</span>
            </li>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Moto.svg') }}" width="20" height="20" alt="Registro de Motos">
                <span>Registro de Motos</span>
            </li>
            <li onclick="window.location.href='{{ route('menu') }}'">
                <img src="{{ asset('images/Home.svg') }}" width="20" height="20" alt="Menú Principal">
                <span>Regresar al Menú</span>
            </li>
            <li class="imprimir" onclick="imprimirPagina()">
                <img src="{{ asset('images/print.svg') }}" width="20" height="20" alt="Imprimir">
                <span>Imprimir</span>
            </li>
            <li class="salir" onclick="salir()">
                <img src="{{ asset('images/power.svg') }}" width="20" height="20" alt="Salir">
                <span>Cerrar sesión</span>
            </li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="titulo"><strong>Código QR Generado</strong></div>

        <div class="confirmacion">
            <div class="icono-menu">
                <a href="{{ route('menu') }}" aria-label="Ir al Menú">
                    <img src="{{ asset('images/cancelar.svg') }}" alt="Ir al Menú" class="menu-icon">
                </a>
            </div>

            <p>Este es tu código QR generado:</p>
            <img src="{{ asset('images/qr_codes/' . $fileName) }}" alt="Código QR" style="width: 300px; height: 300px;">

            <div class="acciones">
                <button onclick="imprimirPagina()">Imprimir</button>
                <button onclick="regresar()">Regresar</button>
            </div>
        </div>
    </div>

</body>

</html>

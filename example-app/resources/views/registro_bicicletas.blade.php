<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registro de Bicicleta</title>
    @vite(['resources/css/registro_bicicletas.css'])
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.querySelector(".toggle-btn");
            const sidebar = document.querySelector(".sidebar");
            const content = document.querySelector(".content");
            const form = document.getElementById('registroForm');
            const previewBici = document.getElementById('preview_bici');
            const previewBiciLarge = document.getElementById('preview_bici_large');
            const mensajeDiv = document.getElementById('mensaje');

            // Función para abrir/ocultar el menú lateral
            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("active");

                if (window.innerWidth > 768) {
                    content.style.marginLeft = sidebar.classList.contains("active") ? "250px" : "0";
                }
            });

            // Ajustar el estado del sidebar al redimensionar la ventana
            window.addEventListener("resize", () => {
                if (window.innerWidth > 768) {
                    sidebar.classList.add("active");
                    content.style.marginLeft = "250px";
                } else {
                    sidebar.classList.remove("active");
                    content.style.marginLeft = "0";
                }
            });

            // Inicializar el estado del sidebar
            if (window.innerWidth > 768) {
                sidebar.classList.add("active");
                content.style.marginLeft = "250px";
            } else {
                sidebar.classList.remove("active");
                content.style.marginLeft = "0";
            }

            // Manejar el evento de reset para borrar las vistas previas
            form.addEventListener("reset", () => {
                previewBici.src = "";
                previewBiciLarge.src = "";
                previewBici.style.display = 'none';
                previewBiciLarge.style.display = 'none';
                mensajeDiv.style.display = 'none';
            });
        });

        function mostrarVistaPrevia(input) {
            const preview = document.getElementById('preview_bici');
            const previewLarge = document.getElementById('preview_bici_large');
            const maxSize = 2 * 1024 * 1024;

            if (input.files && input.files[0]) {
                if (input.files[0].size > maxSize) {
                    alert("El archivo es demasiado grande. El tamaño máximo es 2MB.");
                    input.value = "";
                    preview.style.display = 'none';
                    previewLarge.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewLarge.src = e.target.result;
                    preview.style.display = 'block';
                    previewLarge.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
                previewLarge.style.display = 'none';
            }
        }

        function enviarFormulario(event) {
            event.preventDefault();
            alert("Formulario enviado correctamente.");
        }

        function salir() {
            if (confirm("¿Estás seguro de que deseas salir?")) {
                window.location.href = "{{ route('logout') }}";
            }
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

    <!-- Menú Lateral -->
    <div class="sidebar active">
        <div class="logo">Registro</div>
        <ul>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Car.svg') }}" width="20" height="20" alt="Carros">
                <span>Registro de Carros</span>
            </li>
            <li onclick="mostrarMantenimiento()">
                <img src="{{ asset('images/Moto.svg') }}" width="20" height="20" alt="Motos">
                <span>Registro de Motos</span>
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
        <div class="tabla-container">
            <h2>Registro de Bicicleta</h2>
            <div id="mensaje"></div>

            <form id="registroForm" method="POST" action="{{ route('registro.bicicletas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nombreBicicleta">Nombre de la Bicicleta:</label>
                    <input type="text" id="nombreBicicleta" name="nombreBicicleta" placeholder="Ingresa el nombre de la bicicleta" required>
                </div>

                <div class="form-group">
                    <label for="color">Color:</label>
                    <select id="color" name="color" required>
                        <option value="" disabled selected>Selecciona el color de tu bicicleta</option>
                        <option value="Negro">Negro</option>
                        <option value="Blanco">Blanco</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Azul">Azul</option>
                        <option value="Verde">Verde</option>
                        <option value="Amarillo">Amarillo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fotoBici">Foto de la Bicicleta:</label>
                    <input type="file" id="fotoBici" name="fotoBici" accept="image/*" onchange="mostrarVistaPrevia(this)" required>
                    <img id="preview_bici" class="image-preview" alt="Vista Previa de la Bicicleta">
                    <img id="preview_bici_large" class="image-preview" alt="Vista Previa Grande de la Bicicleta">
                </div>

                <div class="buttons">
                    <button type="reset" class="icon-button" aria-label="Eliminar">
                        <img src="{{ asset('images/delete.svg') }}" alt="Eliminar" class="icon reset-icon">
                    </button>
                    <button type="submit" class="icon-button" aria-label="Guardar">
                        <img src="{{ asset('images/Save.svg') }}" alt="Guardar" class="icon submit-icon">
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

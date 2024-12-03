<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Menú Principal</title>
    @vite(['resources/css/menu.css'])
</head>

<body>

    <!-- Barra de Encabezado -->
    <div class="header">
        <button class="toggle-btn" aria-label="Abrir menú">
            <img src="{{ asset('images/Menu.svg') }}" width="30" height="30" alt="menu">
        </button>
        <img src="{{ asset('images/tecnm.png') }}" alt="Logo TECNM" class="logo">
        <img src="{{ asset('images/itl.png') }}" alt="Logo ITL" class="logo2">
    </div>

    <!-- Menú Lateral -->
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
            <li onclick="window.location.href='{{ route('registro.bicicletas') }}'">
                <img src="{{ asset('images/bici.svg') }}" width="20" height="20" alt="Registro de Bicicletas">
                <span>Registro de Bicicletas</span>
            </li>
            <li onclick="window.location.href='{{ route('perfil') }}'">
                <img src="{{ asset('images/person.svg') }}" width="20" height="20" alt="Perfil">
                <span>Perfil</span>
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
            <!-- Botón de Añadir Registro -->
            <button class="add-button" onclick="agregarRegistro()" title="Agregar Registro">
                <img src="{{ asset('images/nuevo.svg') }}" alt="Agregar Registro">
            </button>

            <h2>Mis Bicicletas Registradas</h2>
            <table class="tabla-registros" id="tablaRegistros">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Fecha de Registro</th>
                        <th>Código QR</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bicicletas as $bicicleta)
                        <tr>
                            <td>{{ $bicicleta->id_bicicleta }}</td>
                            <td>{{ $bicicleta->nombrebici }}</td>
                            <td>{{ $bicicleta->color }}</td>
                            <td>{{ $bicicleta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                            <button class="codigo-qr" onclick="window.location.href='{{ route('codigoQR', ['id_bicicleta' => $bicicleta->id_bicicleta]) }}'" style="background: none; border: none; cursor: pointer;">
                                <img src="{{ asset('images/qr.svg') }}" alt="Codigo QR">
                            </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay bicicletas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

        document.addEventListener("DOMContentLoaded", function () {
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
        });

        function agregarRegistro() {
            window.location.href = "{{ route('registro.bicicletas') }}";
        }

        function verCodigoQR(id) {
            window.location.href = `{{ url('/codigoQR') }}/${id}`;
        }
    </script>
</body>

</html>

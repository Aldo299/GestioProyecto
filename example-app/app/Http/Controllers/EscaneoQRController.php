<?php
namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscaneoQRController extends Controller
{
    public function index()
    {
        return view('escaneo_qr');
    }

    // Función para generar el QR de una bicicleta y mostrarlo
    public function showQRCode($id_bicicleta)
    {
        // Buscar la bicicleta usando su id_bicicleta
        $bicicleta = Bicicleta::findOrFail($id_bicicleta);

        // Obtener el usuario relacionado con la bicicleta (si existe)
        $usuario = $bicicleta->usuario; 

        // Verificar si el usuario existe
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado para esta bicicleta'], 404);
        }

        // Suponiendo que el nombre del archivo de la foto de la bicicleta está almacenado en la columna 'fotoBici'
        $bicicletaFotoUrl = url($bicicleta->fotoBici ); // Foto de la bicicleta

        // Foto del usuario (asumimos que está en 'fotoUsuario')
        $usuarioFotoUrl = url('image/perfil/' . $usuario->fotoUsuario); // Foto del usuario

        // Datos que quieres codificar en el QR (URLs de las fotos y más información)
        $qrData = [
            'noControl' => $bicicleta->no_control,
            'colorBici' => $bicicleta->color,
            'nombreUsuario' => $usuario->usuario,
            'bicicleta' => $bicicleta->nombrebici,
            'bicicleta_foto' => $bicicletaFotoUrl,
            'usuario_foto' => $usuarioFotoUrl,
        ];

        // Convertir el array a JSON o cualquier formato que prefieras
        $qrDataJson = json_encode($qrData);

        // Nombre del archivo QR
        $fileName = 'bicicleta_' . $bicicleta->id_bicicleta . '.png';

        // Llamar al servicio Node.js para generar el QR
        $response = Http::get('http://localhost:3000/generate-qrcode', [
            'data' => $qrDataJson, // Pasamos los datos en formato JSON
            'filename' => $fileName // Nombre del archivo generado
        ]);

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Guardar el archivo generado en la carpeta pública
            $qrPath = public_path('images/qr_codes/' . $fileName); // Carpeta donde se guardará el QR

            // Mover el archivo generado a la carpeta pública
            file_put_contents($qrPath, $response->body());

            // Pasar la ruta del archivo QR a la vista
            return view('codigo_qr', compact('bicicleta', 'fileName'));
        } else {
            // En caso de error al generar el QR
            return response()->json(['error' => 'Error al generar el QR'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bicicleta;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth
use Carbon\Carbon;

class RegistroBicicletasController extends Controller
{
    // Mostrar el formulario de registro de bicicletas
    public function create()
    {
        return view('registro_bicicletas');
    }

    // Guardar la bicicleta en la base de datos
    public function store(Request $request)
{
    try {
        // Validación de los datos
        $request->validate([
            'nombreBicicleta' => 'required|string|max:255',
            'color' => 'required|string',
            'fotoBici' => 'required|image|max:2048', // Validación de imagen
        ]);

        // Subir la imagen de la bicicleta
        $file = $request->file('fotoBici');
        $idBicicleta = Bicicleta::max('id_bicicleta') + 1; // Genera un id único o usa el id actual
        $fileName = $idBicicleta . '.' . $file->getClientOriginalExtension(); // Usamos el id_bicicleta como nombre del archivo

        // Definir la ruta completa para guardar la imagen
        $filePath = public_path('image/data/' . $fileName); // Usamos public_path para guardar en public/image/data

        // Mover el archivo a la nueva ubicación
        $file->move(public_path('image/data'), $fileName); // Mueve el archivo a la carpeta 'public/image/data'

        // Verificar si el archivo se movió correctamente
        if (!file_exists($filePath)) {
            \Log::error('Error al guardar la imagen en image/data: ' . $fileName);
            return back()->with('error', 'No se pudo guardar la imagen.');
        } else {
            \Log::info('Imagen guardada correctamente en: ' . $filePath);
        }

        // Guardamos la bicicleta en la base de datos
        $bicicleta = Bicicleta::create([
            'nombrebici' => $request->input('nombreBicicleta'),
            'color' => $request->input('color'),
            'fotoBici' => 'image/data/' . $fileName, // Guardamos la ruta relativa de la imagen
            'fecha_registro' => Carbon::now()->format('Y-m-d'),
            'no_control' => Auth::user()->no_control, // Asegúrate de tener este campo en la base de datos
        ]);

        return redirect()->route('registro.bicicletas')->with('success', 'Bicicleta registrada exitosamente!');
    } catch (\Exception $e) {
        \Log::error('Error al registrar la bicicleta: ' . $e->getMessage());
        return back()->with('error', 'Ocurrió un error al registrar la bicicleta.');
    }
}



    // Mostrar todas las bicicletas registradas
    public function index()
    {
        $bicicletas = Bicicleta::all(); // Obtener todas las bicicletas
        return view('menu', compact('bicicletas')); // Asegúrate de tener esta vista en resources/views/menu.blade.php
    }
}

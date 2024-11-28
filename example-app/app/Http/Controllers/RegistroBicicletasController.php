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
        $request->validate([
            'nombreBicicleta' => 'required|string|max:255',
            'color' => 'required|string',
            'fotoBici' => 'required|image|max:2048', // Validación de imagen
        ]);

        // Subir la imagen de la bicicleta
        $file = $request->file('fotoBici');
        $idBicicleta = Bicicleta::max('id_bicicleta') + 1; // Genera un id único o usa el id actual
        $fileName = $idBicicleta . '.' . $file->getClientOriginalExtension(); // Usamos el id_bicicleta como nombre del archivo

        // Guardamos la imagen en la carpeta correspondiente
        $filePath = $file->storeAs('public/bicicletas', $fileName);

        // Guardamos la bicicleta en la base de datos
        $bicicleta = Bicicleta::create([
            'nombrebici' => $request->input('nombreBicicleta'),
            'color' => $request->input('color'),
            'fotoBici' => $filePath, // Guardamos la ruta de la imagen
            'fecha_registro' => Carbon::now()->format('Y-m-d'),
            'no_control' => Auth::user()->no_control
        ]);

        return redirect()->route('registro.bicicletas')->with('success', 'Bicicleta registrada exitosamente');
    }


    // Mostrar todas las bicicletas registradas
    public function index()
    {
        $bicicletas = Bicicleta::all(); // Obtener todas las bicicletas
        return view('menu', compact('bicicletas')); // Asegúrate de tener esta vista en resources/views/menu.blade.php
    }
}

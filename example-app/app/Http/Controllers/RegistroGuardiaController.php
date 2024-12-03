<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Guardia;
use Illuminate\Http\Request;

class RegistroGuardiaController extends Controller
{
    // Método para mostrar los registros de bicicletas
    public function index()
    {
        // Obtener todos los registros desde la base de datos (ajustar según sea necesario)
        $registros = Guardia::all();

        // Retornar la vista con los registros
        return view('registro_guardia', compact('registros'));
    }

    // Método para buscar registros por varios criterios
    public function buscar(Request $request)
    {
        $query = Registro::query();

        // Filtrar por ID, Número de Control o cualquier otro campo
        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where('id', 'like', "%$buscar%")
                ->orWhere('numero_control', 'like', "%$buscar%")
                ->orWhere('id_bicicleta', 'like', "%$buscar%")
                ->orWhere('id_punto_acceso', 'like', "%$buscar%");
        }

        // Obtener los registros filtrados
        $registros = $query->get();

        // Retornar la vista con los registros filtrados
        return view('registro_guardia', compact('registros'));
    }
}

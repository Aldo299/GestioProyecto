<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bicicleta;  // Importa el modelo Bicicleta

class MenuController extends Controller
{
    /**
     * Mostrar la vista del menú y todas las bicicletas.
     */
    public function index()
    {
        // Obtener todas las bicicletas desde la base de datos
        $bicicletas = Bicicleta::all();

        // Retornar la vista 'menu' con la variable $bicicletas
        return view('menu', compact('bicicletas'));
    }
}


<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bicicleta;  // Importa el modelo Bicicleta
use Illuminate\Support\Facades\Auth;  // Importa la clase Auth para obtener el usuario autenticado

class MenuController extends Controller
{
    /**
     * Mostrar la vista del menú y las bicicletas del usuario autenticado.
     */
    public function index()
    {
        // Obtener el no_control del usuario autenticado
        $noControl = Auth::user()->no_control;

        // Obtener todas las bicicletas del usuario autenticado
        $bicicletas = Bicicleta::where('no_control', $noControl)->get();

        // Retornar la vista 'menu' con la variable $bicicletas
        return view('menu', compact('bicicletas'));
    }
}



<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PerfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();  // Obtener el usuario autenticado

        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        return view('perfil', compact('user'));  // Pasar el usuario a la vista
    }

    public function actualizar(Request $request)
    {
        $user = Auth::user();  // Obtener el usuario autenticado

        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Validar los datos del formulario
        $request->validate([
            'nuevoFotoPerfil' => 'nullable|image|max:2048',  // Limitar tamaño máximo de 2MB
        ]);

        // Si se sube una nueva foto de perfil
        if ($request->hasFile('nuevoFotoPerfil')) {
            // Obtener el archivo de la foto
            $file = $request->file('nuevoFotoPerfil');
            $fileName = $user->no_control . '.' . $file->getClientOriginalExtension();  // Usar el ID del usuario como nombre del archivo

            // Mover la imagen a 'public/image/perfil'
            $file->move(public_path('image/perfil'), $fileName);  // Mueve la imagen a la carpeta 'public/image/perfil'

            // Eliminar la foto anterior si existe
            if ($user->fotoUsuario && file_exists(public_path('image/perfil/' . $user->fotoUsuario))) {
                // Eliminar archivo anterior
                File::delete(public_path('image/perfil/' . $user->fotoUsuario));
            }

            // Actualizar el campo correcto en la base de datos
            $user->fotoUsuario = $fileName;  // Actualizar la foto de perfil con el nuevo nombre
        }

        // Actualizar el nombre del usuario (si lo cambian)
        if ($request->has('nombreUsuario')) {
            $user->name = $request->input('nombreUsuario');
        }

        $user->save();  // Guardar los cambios en el usuario

        return redirect()->route('perfil')->with('success', 'Perfil actualizado exitosamente!');
    }
}

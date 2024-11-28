<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Models\User;
use App\Models\Guardia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showRegistrationForm()
    {
        return view('registro');  // Retorna la vista de registro que ya has creado
    }
    public function showVerificationPage(Request $request)
    {
        return view('registro_verificacion', ['correo' => $request->correo]);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Maneja la autenticación de los usuarios.
     */
    public function login(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'no_control' => 'required|integer', // Validamos no_control
            'contrasena' => 'required|string',
        ]);

        // Intentar autenticar al usuario usando no_control y contraseña
        $user = User::where('no_control', $request->no_control)->first();

        // Verificamos si el usuario existe y la contraseña es correcta
        if ($user && $user->contrasena == $request->contrasena) {
            // Si la autenticación es exitosa
            Auth::login($user); // Logueamos al usuario

            // Buscar si el usuario es un guardia
            $guardia = Guardia::where('usuario', $user->usuario)->first();

            if ($guardia) {
                // Si es un guardia, redirigir a la página de 'registro_guardia'
                return redirect()->route('registro.guardia');
            } else {
                return redirect()->route('menu');
            }
        }

        // Si la autenticación falla
        return back()->withErrors([
            'no_control' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Cerrar sesión y redirigir al inicio.
     */
    public function logout()
    {
        Auth::logout(); // Cerrar sesión
        return redirect()->route('login'); // Redirigir al formulario de inicio de sesión
    }

    /**
     * Maneja el registro de nuevos usuarios.
     */

     public function register(Request $request)
{
    // Validación de los datos
    $request->validate([
        'usuario' => 'required|string|max:50|unique:Usuarios,usuario',
        'numeroControl' => 'required|string|max:20|unique:Usuarios,no_control',
        'correo' => 'required|string|email|max:255|unique:Usuarios,correo',
        'contrasena' => 'required|string|min:8', // Aseguramos que se pase una contraseña
    ]);

    // Crear un nuevo usuario
    $user = new User();
    $user->usuario = $request->usuario;
    $user->no_control = $request->numeroControl;
    $user->correo = $request->correo;
    $user->fecha_registro = now(); // Fecha de registro

    // Asignar la contraseña (usamos bcrypt para encriptarla)
    $user->contrasena = bcrypt($request->contrasena); // Asegúrate de encriptar la contraseña

    $user->save();

    // Generar un código de verificación aleatorio
    $verificationCode = Str::random(6); // Código aleatorio de 6 caracteres

    // Guardar el código en la base de datos (lo guardamos temporalmente)
    $user->codigo_verificacion = $verificationCode;
    $user->save();

    // Enviar el correo con el código de verificación
    Mail::to($request->correo)->send(new VerificationCodeMail($verificationCode));

    // Redirigir a la página de verificación para que ingrese el código
    return redirect()->route('registro.verificar', ['correo' => $user->correo]);
}

     
 
     /**
      * Verifica el código de verificación.
      *
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\Http\RedirectResponse
      */
     public function verifyCode(Request $request)
     {
         $request->validate([
             'codigoIngresado' => 'required|string|size:6',
         ]);
 
         // Buscar al usuario por correo
         $user = Usuario::where('correo', $request->correo)->first();
 
         if ($user && $user->codigo_verificacion == $request->codigoIngresado) {
             // Código correcto, proceder con el registro
             $user->contrasena = bcrypt($request->password); // Asignar la contraseña
             $user->codigo_verificacion = null; // Limpiar el código
             $user->save();
 
             // Autenticar al usuario
             Auth::login($user);
 
             // Redirigir al usuario al dashboard o página principal
             return redirect()->route('menu');
         }
 
         // Si el código no coincide
         return back()->withErrors(['codigoIngresado' => 'El código de verificación es incorrecto.']);
     }
}

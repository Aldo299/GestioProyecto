<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegistroBicicletasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EscaneoQRController;
use App\Http\Controllers\RegistroGuardiaController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/password/reset', function () {
    return view('restablacer_contraseña');
})->name('password.reset');

Route::get('/password/update', function () {
    return view('establecer_contraseña');
})->name('password.update');

// Esta ruta está protegida por el middleware 'auth'
Route::middleware('auth')->get('/menu', [MenuController::class, 'index'])->name('menu');

Route::post('/registro', [RegistroController::class, 'store'])->name('registro.submit');

Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
Route::post('/perfil', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');

// Ejemplos de rutas para el menú lateral
Route::get('/registro-carros', [RegistroCarrosController::class, 'show'])->name('registro.carros');
Route::get('/registro-motos', [RegistroMotosController::class, 'show'])->name('registro.motos');
Route::get('/registro-bicicletas', [RegistroBicicletasController::class, 'create'])->name('registro.bicicletas');
Route::post('/registro-bicicletas', [RegistroBicicletasController::class, 'store'])->name('registro.bicicletas.store');

Route::get('/registro-guardia', [RegistroGuardiaController::class, 'index'])->name('registro.guardia');

Route::get('/establecer-contraseña', [PasswordController::class, 'create'])->name('password.create');
Route::post('/establecer-contraseña', [PasswordController::class, 'store'])->name('password.store');

// Ruta para volver al inicio
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.submit');
Route::get('/registro/verificar', [AuthController::class, 'showVerificationPage'])->name('registro.verificar');
Route::post('/registro/verificar', [AuthController::class, 'verifyCode'])->name('registro.verificar.submit');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/qr/{id_bicicleta}', [EscaneoQRController::class, 'showQRCode'])->name('codigoQR');


Route::get('/escaneo-qr', [EscaneoQRController::class, 'index'])->name('escaneo-qr');

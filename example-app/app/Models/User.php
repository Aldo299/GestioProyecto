<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Definir el nombre de la tabla si no es 'users'
    protected $table = 'Usuarios'; // Cambia 'Usuarios' si tu tabla tiene otro nombre

    // Usar 'no_control' como clave primaria
    protected $primaryKey = 'no_control'; // Clave primaria

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_control', // Clave primaria
        'usuario',    // Nombre de usuario
        'correo',     // Correo electrónico
        'contrasena', // Contraseña
    ];

    /**
     * Los atributos que deben ser ocultados para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'contrasena' => 'hashed',
        ];
    }

    /**
     * Relación con el modelo Guardia.
     * Verifica si el usuario es un guardia.
     */
    public function guardia()
    {
        return $this->hasOne(Guardia::class, 'usuario', 'usuario');
    }
}

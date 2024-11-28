<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    use HasFactory;

    protected $table = 'Guardias'; // Asegúrate de que este nombre coincida con el nombre de la tabla
    protected $fillable = ['id_guardia', 'ubicacion', 'usuario', 'contrasena'];
}

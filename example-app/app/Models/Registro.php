<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nombre',
        'color',
        'fecha_registro',
    ];

    protected $dates = ['fecha_registro']; // Para manejar fechas como objetos Carbon
}

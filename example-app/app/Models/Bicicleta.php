<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    protected $primaryKey = 'id_bicicleta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nombrebici',
        'color',
        'codigo_qr',
        'fotoBici',
        'no_control',  // Clave foránea
        'fecha_registro'
    ];

    // Relación: Una bicicleta pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'no_control', 'no_control');
    }
}

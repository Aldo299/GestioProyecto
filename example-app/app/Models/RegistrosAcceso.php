<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosAcceso extends Model
{
    use HasFactory;

    // Nombre de la tabla (si es diferente de la convención plural)
    protected $table = 'Registros_Acceso';

    // Definir las relaciones con otros modelos
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'no_control', 'no_control');
    }

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class, 'id_bicicleta', 'id_bicicleta');
    }

    public function guardia()
    {
        return $this->belongsTo(Guardia::class, 'id_guardia', 'id_guardia');
    }

    public function codiQR()
    {
        return $this->belongsTo(CodiQR::class, 'codigo_qr', 'codigo_qr');
    }
}

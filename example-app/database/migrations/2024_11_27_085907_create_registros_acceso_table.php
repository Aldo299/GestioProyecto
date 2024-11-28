<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_registros_acceso_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosAccesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_acceso', function (Blueprint $table) {
            $table->id('id_registro');
            $table->integer('no_control')->nullable();
            $table->unsignedBigInteger('id_bicicleta')->nullable();
            $table->unsignedBigInteger('id_guardia')->nullable();
            $table->string('codigo_qr', 255)->nullable();
            $table->dateTime('fecha_hora');
            $table->timestamps();

            // Relaciones
            $table->foreign('no_control')->references('no_control')->on('usuarios');
            $table->foreign('id_bicicleta')->references('id_bicicleta')->on('bicicletas');
            $table->foreign('id_guardia')->references('id_guardia')->on('guardias');
            $table->foreign('codigo_qr')->references('codigo_qr')->on('codi_qr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros_acceso');
    }
}

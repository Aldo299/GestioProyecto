<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_codi_qr_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodiQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codi_qr', function (Blueprint $table) {
            $table->string('codigo_qr', 255)->primary();
            $table->unsignedBigInteger('id_bicicleta')->nullable();
            $table->integer('no_control')->nullable();
            $table->date('fecha_creacion');
            $table->timestamps();

            // Relaciones
            $table->foreign('id_bicicleta')->references('id_bicicleta')->on('bicicletas');
            $table->foreign('no_control')->references('no_control')->on('usuarios')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codi_qr');
    }
}

<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_bicicletas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBicicletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bicicletas', function (Blueprint $table) {
            $table->id('id_bicicleta');
            $table->string('nombrebici', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->integer('no_control')->nullable();
            $table->date('fecha_registro');
            $table->binary('fotoBici')->nullable();
            $table->timestamps();

            // Relaciones
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
        Schema::dropIfExists('bicicletas');
    }
}

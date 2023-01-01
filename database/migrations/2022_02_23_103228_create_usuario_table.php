<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('usu_nombre', 15);
            $table->string('usu_pwd', 256);
            $table->boolean('usu_activo')->default(true);
            $table->bigInteger('usu_empleado');
            $table->timestamps();
            $table->string('usu_nombrelargo', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}

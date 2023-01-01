<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigInteger('men_id');
            $table->bigInteger('men_padre')->default(0);
            $table->string('men_nombre', 50);
            $table->string('men_url', 100);
            $table->integer('men_orden')->default(0);
            $table->string('men_icono', 50)->nullable();
            $table->boolean('men_deshabilitado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}

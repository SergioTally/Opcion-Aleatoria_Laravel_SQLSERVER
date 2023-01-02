<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hilo', function (Blueprint $table) {
            $table->bigInteger('hl_id', true);
            $table->bigInteger('hl_dd');
            $table->string('hl_descripcion', 500);
            $table->bigInteger('hl_usr');
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
        Schema::dropIfExists('hilo');
    }
};

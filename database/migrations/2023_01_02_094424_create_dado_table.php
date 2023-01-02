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
        Schema::create('dado', function (Blueprint $table) {
            $table->bigInteger('dd_id', true);
            $table->string('dd_codigo', 15);
            $table->string('dd_descripcion', 500);
            $table->date('dd_fecha')->default('getdate()');
            $table->integer('dd_resultado');
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
        Schema::dropIfExists('dado');
    }
};

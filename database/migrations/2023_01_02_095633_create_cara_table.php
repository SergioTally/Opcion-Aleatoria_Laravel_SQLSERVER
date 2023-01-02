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
        Schema::create('cara', function (Blueprint $table) {
            $table->bigInteger('cr_id', true);
            $table->bigInteger('cr_dd');
            $table->string('cr_descripcion', 500);
            $table->integer('cr_orden');
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
        Schema::dropIfExists('cara');
    }
};

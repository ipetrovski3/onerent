<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id');
            $table->string('plate');
            $table->enum('transmission_type', [0, 1]);
            $table->boolean('ac')->default(true);
            $table->integer('max_passengers');
            $table->boolean('navigation')->default(false);
            $table->enum('engine_type', [0, 1, 2, 3, 4]);
            $table->float('ppd');
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
        Schema::dropIfExists('cars');
    }
}

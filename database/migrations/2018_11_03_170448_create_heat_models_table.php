<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeatModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heat_models', function (Blueprint $table) {
            $table->increments('id');
            $table->text('district')->nullable();
            $table->float('nhv')->nullable();
            $table->float('a')->nullable();
            $table->float('b')->nullable();
            $table->float('N83')->nullable();
            $table->float('N82')->nullable();
            $table->float('N8')->nullable();
            $table->float('N5')->nullable();
            $table->float('N0')->nullable();
            $table->float('N_5')->nullable();
            $table->float('N_10')->nullable();
            $table->float('N_15')->nullable();
            $table->float('N_20')->nullable();
            $table->float('N_25')->nullable();
            $table->float('h83')->nullable();
            $table->float('h82')->nullable();
            $table->float('h8')->nullable();
            $table->float('h5')->nullable();
            $table->float('h0')->nullable();
            $table->float('h_5')->nullable();
            $table->float('h_10')->nullable();
            $table->float('h_15')->nullable();
            $table->float('h_20')->nullable();
            $table->float('h_25')->nullable();
            $table->float('Nave')->nullable();
            $table->float('N2hw')->nullable();
            $table->float('Nl')->nullable();
            $table->float('tao')->nullable();
            $table->float('tar')->nullable();
            $table->float('x1')->nullable();
            $table->float('x2')->nullable();
            $table->float('x3')->nullable();
            $table->float('x4')->nullable();
            $table->float('x5')->nullable();
            $table->float('x6')->nullable();
            $table->float('x7')->nullable();
            $table->float('x8')->nullable();
            $table->float('x9')->nullable();
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
        Schema::dropIfExists('heat_models');
    }
}

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
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
             $table->unsignedInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->text('title');
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
            $table->float('t1')->nullable();
            $table->float('t2')->nullable();
            $table->float('t3')->nullable();
            $table->float('t4')->nullable();
            $table->float('t5')->nullable();
            $table->float('t6')->nullable();
            $table->float('t7')->nullable();
            $table->float('t8')->nullable();
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
            $table->float('ril')->nullable();
            $table->float('pef')->nullable();
            $table->float('x1')->nullable();
            $table->float('x2')->nullable();
            $table->float('x3')->nullable();
            $table->float('x4')->nullable();
            $table->float('x5')->nullable();
            $table->float('x6')->nullable();
            $table->float('x7')->nullable();
            $table->float('x8')->nullable();
            $table->float('x9')->nullable();
            $table->unsignedInteger('createdBy')->nullable();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('heat_model_id');
            $table->foreign('heat_model_id')->references('id')->on('heat_models');
            $table->unsignedInteger('parameter_id');
            $table->foreign('parameter_id')->references('id')->on('parameters');
            $table->float('january')->nullable();
            $table->float('february')->nullable();
            $table->float('march')->nullable();
            $table->float('april')->nullable();
            $table->float('may')->nullable();
            $table->float('june')->nullable();
            $table->float('july')->nullable();
            $table->float('august')->nullable();
            $table->float('september')->nullable();
            $table->float('october')->nullable();
            $table->float('november')->nullable();
            $table->float('december')->nullable();
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
        Schema::dropIfExists('months');
    }
}

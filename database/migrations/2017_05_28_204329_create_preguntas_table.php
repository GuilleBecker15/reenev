<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
<<<<<<< HEAD
            $table->string('enunciado');//->unique();
=======

            $table->string('enunciado')->unique();
>>>>>>> fb62f5417a478349f4e57e0427a2b4b7ea9fa81e
            $table->integer('numero');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}

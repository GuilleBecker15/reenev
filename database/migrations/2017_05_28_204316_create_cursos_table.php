<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        $this->down();
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique()->default("");
            $table->string('abreviatura')->unique()->default("");
            $table->integer('semestre')->default(1);
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->rememberToken();
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
        Schema::dropIfExists('cursos');
    }
}

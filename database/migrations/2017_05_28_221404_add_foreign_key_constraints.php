<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            //$table->integer('docente_id')->unsigned();
            //$table->foreign('docente_id')->references('id')->on('docentes');
        });

        Schema::table('preguntas', function (Blueprint $table) {
            $table->integer('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')->references('id')->on('encuestas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos', function (Blueprint $table) {
            //$table->dropForeign('cursos_docente_id_foreign');
            //$table->dropColumn('docente_id');
        });

        Schema::table('preguntas', function (Blueprint $table) {
            $table->dropForeign('preguntas_encuesta_id_foreign');
            $table->dropColumn('encuesta_id');
        });


    }
}

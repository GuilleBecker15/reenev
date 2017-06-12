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
            $table->unique(['enunciado','encuesta_id']);

        });

        Schema::table('realizadas', function (Blueprint $table) {
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->integer('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')->references('id')->on('encuestas');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('respuestas', function (Blueprint $table) {
            $table->integer('pregunta_id')->unsigned();
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
            $table->integer('realizada_id')->unsigned();
            $table->foreign('realizada_id')->references('id')->on('realizadas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*        
        $has_docente_id = Schema::hasColumn('cursos', 'docente_id');

        if ($has_docente_id) {
            Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign('cursos_docente_id_foreign');
            $table->dropColumn('docente_id');});
        }

        Schema::table('cursos', function (Blueprint $table) {
            //$table->dropForeign('cursos_docente_id_foreign');
            //$table->dropColumn('docente_id');
        });
*/
        $has_encuesta_id = Schema::hasColumn('preguntas', 'encuesta_id');

        if ($has_encuesta_id) {
            Schema::table('preguntas', function (Blueprint $table) {
            $table->dropForeign('preguntas_encuesta_id_foreign');
            $table->dropColumn('encuesta_id');});
        }

        $has_curso_id = Schema::hasColumn('realizadas', 'curso_id');
        $has_encuesta_id = Schema::hasColumn('realizadas', 'encuesta_id');
        $has_user_id = Schema::hasColumn('realizadas', 'user_id');

        if ($has_curso_id && $has_encuesta_id && $has_user_id) {
            Schema::table('realizadas', function (Blueprint $table) {
            $table->dropForeign('realizadas_curso_id_foreign');
            $table->dropColumn('curso_id');
            $table->dropForeign('realizadas_encuesta_id_foreign');
            $table->dropColumn('encuesta_id');
            $table->dropForeign('realizadas_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('realizadas_docente_id_foreign');
            $table->dropColumn('docente_id');});
        }

        $has_pregunta_id = Schema::hasColumn('respuestas', 'pregunta_id');
        $has_realizada_id = Schema::hasColumn('respuestas', 'realizada_id');

        if ($has_pregunta_id && $has_realizada_id) {
            Schema::table('respuestas', function (Blueprint $table) {
            $table->dropForeign('respuestas_pregunta_id_foreign');
            $table->dropColumn('pregunta_id');
            $table->dropForeign('respuestas_realizada_id_foreign');
            $table->dropColumn('realizada_id');});
        }

    }

}

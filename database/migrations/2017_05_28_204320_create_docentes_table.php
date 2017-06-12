<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->default("");
            $table->string('ci')->unique()->default("");
            $table->string('nombre')->default("");
            $table->string('apellido')->default("");
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
        Schema::dropIfExists('curso_docente');
        Schema::dropIfExists('docentes');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supervisor')->default(0);
            $table->string('name1');
            $table->string('name2');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->date('nacimiento');
            $table->string('generacion');
            $table->string('ci')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('esAdmin')->default(false);
            $table->boolean('estaBorrado')->default(false);
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments('id');

            $table->date('inicio')->default(Carbon::now()->toDateString());
            $table->date('vence')->default(Carbon::now()->toDateString());
            $table->string('asunto')->default("");
            $table->string('descripcion')->default("");
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['vence','asunto','descripcion']);

        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuestas');
    }
}

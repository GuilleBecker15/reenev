<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AllTest extends TestCase
{

	public function test() {

		for ($i=1; $i<=100; $i++) {
		
			$curso = factory(\App\Curso::class)->make();
			$docente = factory(\App\Docente::class)->make();
			$encuesta = factory(\App\Encuesta::class)->make();
			$pregunta = factory(\App\Pregunta::class)->make();
			$realizada = factory(\App\Realizada::class)->make();
			$respuesta = factory(\App\Respuesta::class)->make();
			$user = factory(\App\User::class)->make();

			$docente->save();
			
			$curso->docente_id = rand(1, $i);
			$curso->save();
			
			$encuesta->save();
			
			$pregunta->encuesta_id = rand(1, $i);
			$pregunta->save();
			
			$user->save();
			
			$realizada->curso_id = rand(1, $i);
			$realizada->encuesta_id = rand(1, $i);
			$realizada->user_id = rand(1, $i);
			$realizada->save();

			$respuesta->pregunta_id = rand(1, $i);
			$respuesta->realizada_id = rand(1, $i);
			$respuesta->save();

			echo PHP_EOL;
			echo "------------------------------------";
			echo PHP_EOL;
			echo "user[".$i."]->ci = ".$user->ci;

			if ($user->esAdmin) echo " (esAdmin)";

		}
    
    }

}

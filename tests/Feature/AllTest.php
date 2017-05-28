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
		
			$docente = factory(\App\Docente::class)->make();
			$curso = factory(\App\Curso::class)->make();
			$encuesta = factory(\App\Encuesta::class)->make();
			$user = factory(\App\User::class)->make();

			$docente->save();
			$curso->docente_id = rand(1, $i);
			$curso->save();
			$encuesta->save();
			$user->save();

			echo PHP_EOL;
			echo "------------------------------------";
			echo PHP_EOL;
			echo "user[".$i."]->ci = ".$user->ci;

			if ($user->esAdmin) echo " (esAdmin)";

		}
    
    }

}

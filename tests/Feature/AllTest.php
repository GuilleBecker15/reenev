<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AllTest extends TestCase
{

	public function test() {

		for ($i=1;$i<=100;$i++) {
		
			$curso = factory(\App\Curso::class)->create();
			$docente = factory(\App\Docente::class)->create();
			$encuesta = factory(\App\Encuesta::class)->create();
			$user = factory(\App\User::class)->create();

			echo "\n";
			echo "user[".$i."]->ci = ".$user->ci;

			if ($user->esAdmin) echo " (esAdmin)";

		}
    
    }

}

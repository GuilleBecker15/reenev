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
		
			$user = factory(\App\User::class)->create();
			$docente = factory(\App\Docente::class)->create();
			$curso = factory(\App\Curso::class)->create();

			echo "\n";
			echo "user[".$i."]->ci = ".$user->ci;

			if ($user->esAdmin) echo " (esAdmin)";

		}
    
    }

}

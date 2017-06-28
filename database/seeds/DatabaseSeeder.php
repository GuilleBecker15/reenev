<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		for ($i=1; $i<=10; $i++) {

			$curso = factory(\App\Curso::class)->make();
			$docente = factory(\App\Docente::class)->make();
			$encuesta = factory(\App\Encuesta::class)->make();
			$pregunta = factory(\App\Pregunta::class)->make();
			$user = factory(\App\User::class)->make();

			$curso->save();
			$docente->save();
			
			for ($j=1; $j<=rand(1, $i); $j++) {

				$docente_para_curso = \App\Docente::find(rand(1, $i));
				
				if (!$curso->docentes()->where('id', $docente_para_curso->id)->first()) {
					$curso->docentes()->attach($docente_para_curso);
				}
			
			}
			
			$encuesta->save();
			
			$pregunta->encuesta_id = rand(1, $i);
			$pregunta->save();
			
			$user->save();
			echo "user[".$i."]->ci = ".$user->ci;
			if ($user->esAdmin) echo " (esAdmin)";
			echo PHP_EOL;
		
		}
    
    }

}

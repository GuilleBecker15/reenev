<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Traits\Utilidades;
use App\Http\Traits\AllFaker;

class AllTest extends DuskTestCase
{

    use Utilidades;

    /**
    * A Dusk test example.
    *
    * @return void
    */
    public function testRegister()
    {

        $this->browse(function (Browser $browser) {

            $faker = \Faker\Factory::create();
            $faker->addProvider(new \App\Http\Traits\AllFaker($faker));

            $path = 'http://localhost:8000/register';
            $password = 'lalala';

            $browser
            ->visit($path)
            ->type('name1', $faker->firstName)
            ->type('name2', $faker->firstName)
            ->type('apellido1', $faker->lastName)
            ->type('apellido2', $faker->lastName)
            ->type('nacimiento', $faker->date($format = 'd/m/Y', $max = 'now'))
            ->select('generacion', rand(2008,(int)date("Y")))
            ->type('ci', $faker->unique()->cedula)
            ->type('email', $faker->unique()->safeEmail)
            ->type('password', $password)
            ->type('password_confirmation', $password)
            ->press('Registrarme')->assertPathIsNot($path);
            
        });

    }

}

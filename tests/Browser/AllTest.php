<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Traits\Utilidades;

class AllTest extends DuskTestCase
{

    use Utilidades;

    /**
    * A Dusk test example.
    *
    * @return void
    */
    public function test()
    {

        $this->browse(function (Browser $browser) {

            $path = 'http://localhost:8000/register';
            $password = 'lalala';

            $browser
            ->visit($path)
            ->type('name1', $this->nombre_aleatorio())
            ->type('name2', $this->nombre_aleatorio())
            ->type('apellido1', $this->nombre_aleatorio())
            ->type('apellido2', $this->nombre_aleatorio())
            ->type('nacimiento', $this->fecha_aleatoria())
            ->select('generacion')
            ->type('ci', $this->cedula_aleatoria())
            ->type('email', $this->correo_aleatorio())
            ->type('password', $password)
            ->type('password_confirmation', $password)
            ->press('Registrarme');
            
        });

    }

}

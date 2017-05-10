<?php

namespace App\Http\Traits;

use App\Modelo;

trait Utilidades {

    public function autorizar()
    {
    	$this->authorize('accion', Modelo::class);
    }

}
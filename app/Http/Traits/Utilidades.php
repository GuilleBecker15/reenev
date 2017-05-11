<?php

namespace App\Http\Traits;

use App\Modelo;

trait Utilidades {

    public function autorizar()
    {
    	$this->authorize('accion', Modelo::class);
    }

    public function sqlDateFormat($cadena)
    {
        //Recibe "dd/mm/aaaa" y retorna "aaaa-mm-dd"

        $arreglo = explode("/", $cadena);
        
        $aaaa = $arreglo[2];
        $mm = $arreglo[1];
        $dd = $arreglo[0];

        return $aaaa."-".$mm."-".$dd;

    }

}
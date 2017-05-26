<?php

namespace App\Http\Traits;

trait Utilidades {

    public function sqlDateFormat($uyDateFormat)
    {
        //Recibe "dd/mm/aaaa" y retorna "aaaa-mm-dd"

        $arreglo = explode("/", $uyDateFormat);
        
        $dd = $arreglo[0];
        $mm = $arreglo[1];
        $aaaa = $arreglo[2];

        return $aaaa."-".$mm."-".$dd;

    }

    public function uyDateFormat($sqlDateFormat)
    {
        //Recibe "aaaa-mm-dd" y retorna "dd/mm/aaaa"

        $arreglo = explode("-", $sqlDateFormat);
        
        $aaaa = $arreglo[0];
        $mm = $arreglo[1];
        $dd = $arreglo[2];

        return $dd."/".$mm."/".$aaaa;

    }

    public function es_fecha($string) {
        $date = \DateTime::createFromFormat('Y-m-d', $string);
        return $date && ($date->format('Y-m-d') === $string);
    }

    public function digito_verificador($ci) {
        //Por hacer...
    }

}
<?php

namespace App;

use App\Http\Traits\Utilidades;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{

    use Utilidades;

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

    public function uyInicioVence($inicio_vence)
    {
        return $this->uyDateFormat($inicio_vence);
    }

}

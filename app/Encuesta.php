<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

}

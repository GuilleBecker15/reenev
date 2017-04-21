<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    
    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta');
    }

}

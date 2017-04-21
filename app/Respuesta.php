<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{

    public function realizada()
    {
    	return $this->belongsTo('App\Realizada');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }

}

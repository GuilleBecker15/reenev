<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realizada extends Model
{

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    public function encuesta()
    {
    	return $this->belongsTo('App\Encuesta');
    }

}

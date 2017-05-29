<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Utilidades;

class Realizada extends Model
{

    use Utilidades;

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

    public function uyCuando($cuando)
    {
        return $this->uyDateFormat($cuando);
    }

}

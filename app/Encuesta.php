<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{

	protected $fillable = [
		'asunto',
		'descripcion',
		'inicio',
		'vence',
	];

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

}

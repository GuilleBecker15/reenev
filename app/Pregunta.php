<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{    
    use SoftDeletes;

    protected $fillable = [
		'enunciado',
		'numero',
		'encuesta_id'
	];

    protected $dates = ['deleted_at'];

    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta');
    }

}

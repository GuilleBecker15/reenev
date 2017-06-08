<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{

	use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
		'enunciado',
		'numero',
		'encuesta_id'
	];

    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta');
    }

}

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

    protected $dates = ['deleted_at'];
    
    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

    // public static function boot ()
    // {
    //     parent::boot();

    //     self::deleting(function (Preguntas $preguntas) {

            
    //             $preguntas->delete();
            
    //     });
    // }

}

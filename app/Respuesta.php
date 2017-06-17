<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuesta extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function realizada()
    {
    	return $this->belongsTo('App\Realizada');
    }

    public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }

}

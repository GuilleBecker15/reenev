<?php

namespace App;

use App\Http\Traits\Utilidades;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encuesta extends Model
{

    use SoftDeletes;
    use Utilidades;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

    public function uyInicioVence($inicio_vence)
    {
        return $this->uyDateFormat($inicio_vence);
    }

}

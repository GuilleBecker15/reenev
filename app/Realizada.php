<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Utilidades;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realizada extends Model
{

    use SoftDeletes;
    use Utilidades;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function uyCuando($cuando)
    {
        return $this->uyDateFormat($cuando);
    }

}

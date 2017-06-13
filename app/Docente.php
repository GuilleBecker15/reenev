<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{

	use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->belongsToMany('App\Curso');
    }

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

}

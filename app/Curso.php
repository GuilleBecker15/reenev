<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{

	use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function docente()
    {
    	return $this->belongsTo('App\Docente');
    }

}

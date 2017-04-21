<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

	public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function docente()
    {
    	return $this->belongsTo('App\Docente');
    }

}

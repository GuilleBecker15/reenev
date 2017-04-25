<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPasswordNotification($token));
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name1',
        'name2',
        'apellido1',
        'apellido2',
        'nacimiento',
        'generacion',
        'ci',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cursos()
    {
        return $this->belongsToMany('App\Curso');
    }

    public function realizadas()
    {
        return $this->hasMany('App\Realizada');
    }

}
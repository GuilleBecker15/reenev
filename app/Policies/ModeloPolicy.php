<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeloPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        //Si el logueado es admin: Le autoriza el acceso a cualquier accion...
        return $user->esAdmin;
    }

    public function accion()
    {
        //Sino: Se utiliza esta accion auxiliar que siempre deniega el acceso.
        return false;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

}

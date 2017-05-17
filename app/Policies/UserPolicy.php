<?php

namespace App\Policies;

use App\User;

class UserPolicy
{

    public function es_admin(User $user)
    {
        return $user->esAdmin;
    }

    public function es_admin_o_es_el(User $user, User $other_user)
    {
        return $user->esAdmin||($user->id === $other_user->id);
    }

}
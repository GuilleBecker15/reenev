<?php

namespace App\Policies;

use App\User;

class UserPolicy {

	/*

	01) P = "El user autenticado es admin"
	02) Q = "El user autenticado es el otro user"
	03) noP
	04) noQ
	05) P o Q
	06) P y Q
	07) noP o Q
	08) noP y Q
	09) P o noQ
	10) P y noQ
	11) noP o noQ
	12) noP y noQ
	--------------------------------------------------------------
	13) R = "El admin autenticado es el supervisor del otro admin"

	*/

    public function es_admin(User $logged) {
        return $logged->esAdmin; //1
    }

    public function es_el(User $logged, User $other) {
        return $logged->id === $other->id; //2
    }

    public function no_es_admin(User $logged) {
        return !$logged->esAdmin; //3
    }

    public function no_es_el(User $logged, User $other) {
        return $logged->id !== $other->id; //4
    }

    public function es_admin_o_es_el(User $logged, User $other) {
        return $logged->esAdmin || ($logged->id===$other->id); //5
    }

    public function es_admin_y_es_el(User $logged, User $other) {
        return $logged->esAdmin && ($logged->id===$other->id); //6
    }
    
    public function no_es_admin_o_es_el(User $logged, User $other) {
        return !$logged->esAdmin || ($logged->id===$other->id); //7
    }

    public function no_es_admin_y_es_el(User $logged, User $other) {
        return !$logged->esAdmin && ($logged->id===$other->id); //8
    }

    public function es_admin_o_no_es_el(User $logged, User $other) {
        return $logged->esAdmin || ($logged->id!==$other->id); //9
    }

    public function es_admin_y_no_es_el(User $logged, User $other) {
        return $logged->esAdmin && ($logged->id!==$other->id); //10
    }

    public function no_es_admin_o_no_es_el(User $logged, User $other) {
        return !$logged->esAdmin || ($logged->id!==$other->id); //11
    }

    public function no_es_admin_y_no_es_el(User $logged, User $other) {
        return !$logged->esAdmin && ($logged->id!==$other->id); //12
    }

	//--------------------------------------------------------------

    public function es_supervisor(User $logged, User $other) {

	    /*

	    Cuando un admin hace admin a otro user, su id se graba en el campo "supervisor".
	    La categoria de un admin es la parte positiva de este numero entero.
		
		Un user con el campo "supervisor" igual a cero, signfica que nadie lo supervisa,
		pero que tampoco es un admin de algun tipo.

		Un admin con el campo "supervisor" mayor a cero, signfica que no tiene categoria.

		*/

    	$logged_es_mayor = ($logged->supervisor<$other->supervisor);
    	$other_no_tiene_supervisor = ($other->supervisor===0);
    	$logged_es_supervisor = ($logged->id===$other->supervisor);

    	if ($logged_es_mayor) return true;
    	if ($other_no_tiene_supervisor) return true;
    	if ($logged_es_supervisor) return true;

    	return false;

    }

}
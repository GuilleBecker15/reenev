<?php

namespace Faker\Provider;

class AllFaker extends \Faker\Provider\Base
{
	public function cedula() {

		//Ej.: C.I.: 1.234.567-X -> X = [(1x8)+(2x1)+(3x2)+(4x3)+(5x4)+(6x7)+(7x6)] mod 10 -> X = [8+2+6+12+20+42+42] mod 10 = 132 mod 10 = 2

		$_1 = rand(0,9);
        $_2 = rand(0,9);
        $_3 = rand(0,9);
        $_4 = rand(0,9);
        $_5 = rand(0,9);
        $_6 = rand(0,9);
        $_7 = rand(0,9);

        $x = ($_1*8+$_2*1+$_3*2+$_4*3+$_5*4+$_6*7+$_7*6)%10;

        return $_1.'.'.$_2.$_3.$_4.'.'.$_5.$_6.$_7.'-'.$x;

    }

}
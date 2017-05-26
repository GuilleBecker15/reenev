<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\User::class, function (Faker\Generator $faker) {
    
    static $password;
	
	$faker->addProvider(new \Faker\Provider\AllFaker($faker));

    return [
        'name1' => $faker->firstName,
        'name2' => $faker->firstName,
        'apellido1' => $faker->lastName,
        'apellido2' => $faker->lastName,
        'generacion' => $faker->year($max = 'now'),
        'nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'ci' => $faker->unique()->cedula,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('lalala'),
        'remember_token' => str_random(10),
        'esAdmin' => $faker->boolean,
    ];

});

$factory->define(App\Docente::class, function (Faker\Generator $faker) {
    	
    $faker->addProvider(new \Faker\Provider\AllFaker($faker));

    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'ci' => $faker->unique()->cedula,
        'email' => $faker->unique()->safeEmail,
    ];

});

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    	
    return [
        'nombre' => $faker->unique()->name,
        'abreviatura' => $faker->unique()->word,
        'semestre' => $faker->randomDigit,
    ];

});

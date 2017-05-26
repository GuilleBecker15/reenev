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

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
        
    return [
        'nombre' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        'abreviatura' => $faker->unique()->word,
        'semestre' => rand(1,6),
    ];

});

$factory->define(App\Docente::class, function (Faker\Generator $faker) {
    	
    $faker->addProvider(new \App\Http\Traits\AllFaker($faker));

    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'ci' => $faker->unique()->cedula,
        'email' => $faker->unique()->safeEmail,
    ];

});

$factory->define(App\Encuesta::class, function (Faker\Generator $faker) {

    $inicio = $faker->date($format = 'Y-m-d', $max = 'now');
    $vence = new DateTime($inicio);
    $vence->add(new DateInterval('P30D'));

    return [
        'inicio' => $inicio,
        'vence' => $vence->format('Y-m-d'),
        'asunto' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'descripcion' => $faker->sentence($nbWords = 10, $variableNbWords = true),
    ];

});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    
    static $password;
    
    $faker->addProvider(new \App\Http\Traits\AllFaker($faker));

    return [
        'name1' => $faker->firstName,
        'name2' => $faker->firstName,
        'apellido1' => $faker->lastName,
        'apellido2' => $faker->lastName,
        'nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'generacion' => rand(2008,(int)date("Y")),
        'ci' => $faker->unique()->cedula,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('lalala'),
        'esAdmin' => $faker->boolean,
        'remember_token' => str_random(10),
    ];

});
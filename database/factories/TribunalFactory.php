<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Data\Models\Tribunal::class, function (Faker $faker) {
    return [
        'nome' => only_letters_and_space($faker->name),
        'url_api' => only_letters_and_space($faker->name),
        'abreviacao' => only_letters_and_space($faker->name),
    ];
});

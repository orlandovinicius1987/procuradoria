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

$factory->define(App\Data\Models\TipoJuiz::class, function (Faker $faker) {
    return ['nome' => only_letters_and_space($faker->name)];
});

$factory->define(App\Data\Models\Juiz::class, function (Faker $faker) {
    return [
        'nome' => only_letters_and_space($faker->name),
        'lotacao_id' => function () {
            return factory(\App\Data\Models\Tribunal::class)->create()->id;
        },
        'tipo_juiz_id' => function () {
            return factory(\App\Data\Models\TipoJuiz::class)->create()->id;
        }
    ];
});

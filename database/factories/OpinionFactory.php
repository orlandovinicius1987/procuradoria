<?php

use App\Models\Opinion as OpinionModel;
use App\Models\User as UserModel;
use App\Models\OpinionScope as OpinionScopeModel;
use App\Models\OpinionsSubject as OpinionsSubjectModel;
use App\Models\OpinionSubject as OpinionSubjectModel;
use App\Models\OpinionType as OpinionTypeModel;
use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Data\Repositories\OpinionScopes as OpinionScopesRepository;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;
use App\Data\Repositories\OpinionTypes as OpinionTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
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

$factory->define(OpinionScopeModel::class, function (Faker $faker) {
    return ['name' => only_letters_and_space($faker->name)];
});

$factory->define(OpinionSubjectModel::class, function (Faker $faker) {
    return ['name' => only_letters_and_space($faker->name)];
});

$factory->define(OpinionsSubjectModel::class, function (Faker $faker) {
    return [
        'opinion_id' => app(OpinionsRepository::class)->randomElement()->id,
        'subject_id' => app(OpinionSubjectsRepository::class)->randomElement()
            ->id,
    ];
});

$factory->define(OpinionTypeModel::class, function (Faker $faker) {
    return ['name' => only_letters_and_space($faker->name)];
});

$factory->define(OpinionModel::class, function (Faker $faker) {
    return [
        'opinion_scope_id' => app(
            OpinionScopesRepository::class
        )->randomElement()->id,
        'opinion_type_id' => app(OpinionTypesRepository::class)->randomElement()
            ->id,
        'authorable_id' => $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Procurador')
                ->toArray()
        )['id'],
        'authorable_type' => UserModel::class,
        'suit_number' => only_letters_and_space($faker->name),
        'suit_sheet' => only_letters_and_space($faker->name),
        'identifier' => only_letters_and_space($faker->name),
        'date' => $faker->date,
        'party' => only_letters_and_space($faker->name),
        'abstract' => $faker->text,
        'opinion' => $faker->text,
        'file_pdf' => $faker->text,
        'file_doc' => $faker->text,
        'created_by' => app(UsersRepository::class)->randomElement()->id,
        'updated_by' => app(UsersRepository::class)->randomElement()->id,
    ];
});

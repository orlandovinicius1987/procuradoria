<?php
namespace Database\Factories;

use App\Data\Repositories\OpinionScopes as OpinionScopesRepository;
use App\Data\Repositories\OpinionTypes as OpinionTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Models\Opinion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Data\Repositories\OpinionsSubjects as OpinionsSubjectsRepository;

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

//$factory->define(OpinionSubjectModel::class, function (Faker $faker) {
//    return [
//        'parent_id' => app(OpinionSubjectsRepository::class)->randomElement()
//            ->id,
//        'name' => only_letters_and_space($faker->name)
//    ];
//});
//
//$factory->define(OpinionsSubjectModel::class, function (Faker $faker) {
//    return [
//        'opinion_id' => app(OpinionsRepository::class)->randomElement()->id,
//        'subject_id' => app(OpinionSubjectsRepository::class)->randomElement()
//            ->id
//    ];
//});
//
//$factory->define(OpinionTypeModel::class, function (Faker $faker) {
//    return ['name' => only_letters_and_space($faker->name)];
//});
//
//$factory->define(OpinionModel::class, function (Faker $faker) {
//    return [
//        'opinion_scope_id' => app(
//            OpinionScopesRepository::class
//        )->randomElement()->id,
//        'opinion_type_id' => app(OpinionTypesRepository::class)->randomElement()
//            ->id,
//        'authorable_id' => $faker->randomElement(
//            app(UsersRepository::class)
//                ->getByType('Procurador')
//                ->toArray()
//        )['id'],
//        'authorable_type' => UserModel::class,
//        'suit_number' => only_letters_and_space($faker->name),
//        'suit_sheet' => only_letters_and_space($faker->name),
//        'identifier' => only_letters_and_space($faker->name),
//        'date' => $faker->date,
//        'party' => only_letters_and_space($faker->name),
//        'abstract' => $faker->text,
//        'opinion' => $faker->text,
//        'file_pdf' => $faker->text,
//        'file_doc' => $faker->text,
//        'created_by' => app(UsersRepository::class)->randomElement()->id,
//        'updated_by' => app(UsersRepository::class)->randomElement()->id
//    ];
//});

class OpinionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Opinion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'opinion_scope_id' => app(OpinionScopesRepository::class)->randomElement()->id,
            'opinion_type_id' => app(OpinionTypesRepository::class)->randomElement()->id,
            'authorable_id' => $this->faker->randomElement(
                app(UsersRepository::class)
                    ->getByType('Procurador')
                    ->toArray()
            )['id'],
            'authorable_type' => UserModel::class,
            'suit_number' => only_letters_and_space($this->faker->name),
            'suit_sheet' => only_letters_and_space($this->faker->name),
            'identifier' => only_letters_and_space($this->faker->name),
            'date' => $this->faker->date,
            'party' => only_letters_and_space($this->faker->name),
            'abstract' => $this->faker->text,
            'opinion' => $this->faker->text,
            'file_pdf' => $this->faker->text,
            'file_doc' => $this->faker->text,
            'created_by' => app(UsersRepository::class)->randomElement()->id,
            'updated_by' => app(UsersRepository::class)->randomElement()->id,
        ];
    }
}

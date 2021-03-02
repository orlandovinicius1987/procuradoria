<?php
namespace Database\Factories;

use App\Data\Repositories\OpinionScopes as OpinionScopesRepository;
use App\Data\Repositories\OpinionTypes as OpinionTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Models\Opinion;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'opinion_scope_id' => app(
                OpinionScopesRepository::class
            )->randomElement()->id,
            'opinion_type_id' => app(
                OpinionTypesRepository::class
            )->randomElement()->id,
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
            'updated_by' => app(UsersRepository::class)->randomElement()->id
        ];
    }
}

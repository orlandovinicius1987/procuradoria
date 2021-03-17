<?php
namespace Database\Factories;

use App\Data\Repositories\OpinionScopes as OpinionScopesRepository;
use App\Data\Repositories\OpinionTypes as OpinionTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Models\Opinion;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User as UserModel;

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
            'is_active'=>$this->faker->boolean,
        ];
    }
}

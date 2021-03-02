<?php
namespace Database\Factories;

use App\Models\Tribunal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TribunalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tribunal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => only_letters_and_space($this->faker->name),
            'url_api' => only_letters_and_space($this->faker->name),
            'abreviacao' => only_letters_and_space($this->faker->name)
        ];
    }
}

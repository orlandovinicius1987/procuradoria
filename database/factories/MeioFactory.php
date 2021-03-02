<?php
namespace Database\Factories;

use App\Models\Meio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MeioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['nome' => only_letters_and_space($this->faker->name)];
    }
}

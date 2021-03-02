<?php
namespace Database\Factories;

use App\Models\OpinionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OpinionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpinionType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['name' => only_letters_and_space($faker->name)];
    }
}

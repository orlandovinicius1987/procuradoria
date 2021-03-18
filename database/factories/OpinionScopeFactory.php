<?php
namespace Database\Factories;
use App\Models\OpinionScope;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OpinionScopeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpinionScope::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['name' => only_letters_and_space($this->faker->name)];
    }
}

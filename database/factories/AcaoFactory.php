<?php
namespace Database\Factories;

use App\Models\Acao;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AcaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Acao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => only_letters_and_space($faker->name),
            'abreviacao' => only_letters_and_space($faker->name)
        ];
    }
}

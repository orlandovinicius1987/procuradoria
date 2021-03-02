<?php
namespace Database\Factories;

use App\Models\Juiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Juiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => only_letters_and_space($faker->name),
            'lotacao_id' => function () {
                return factory(\App\Models\Tribunal::class)->create()->id;
            },
            'tipo_juiz_id' => function () {
                return factory(\App\Models\TipoJuiz::class)->create()->id;
            }
        ];
    }
}

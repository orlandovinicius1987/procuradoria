<?php
namespace Database\Factories;

use App\Models\Juiz;
use App\Models\Tribunal;
use App\Models\TipoJuiz;
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
            'nome' => only_letters_and_space($this->faker->name),
            'lotacao_id' => function () {
                return Tribunal::factory()->create()->id;
            },
            'tipo_juiz_id' => function () {
                return TipoJuiz::factory()->create()->id;
            }
        ];
    }
}

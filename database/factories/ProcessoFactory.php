<?php
namespace Database\Factories;

use App\Models\Processo;
use App\Models\Acao;
use App\Models\Juiz;
use App\Models\User;
use App\Models\Tribunal;
use App\Models\Meio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProcessoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Processo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_judicial' => $this->faker->randomNumber(4),
            'numero_alerj' => $this->faker->randomNumber(4),
            'tribunal_id' => function () {
                return Tribunal::factory()->create()->id;
            },
            'vara' => only_letters_and_space($this->faker->name), //'origem_complemento' => only_letters_and_space($this->faker->name),
            'data_distribuicao' => $this->faker->date('Y-m-d h:m:i'),
            'acao_id' => function () {
                return Acao::factory()->create()->id;
            },
            'relator_id' => function () {
                return Juiz::factory()->create()->id;
            },
            'apensos_obs' => only_letters_and_space($this->faker->name),
            'juiz_id' => function () {
                return Juiz::factory()->create()->id;
            },
            'autor' => only_letters_and_space($this->faker->name),
            'reu' => only_letters_and_space($this->faker->name),
            'objeto' => only_letters_and_space($this->faker->name),
            'ementa' => only_letters_and_space($this->faker->name),
            'merito' => only_letters_and_space($this->faker->name),
            'liminar' => only_letters_and_space($this->faker->name),
            'recurso' => only_letters_and_space($this->faker->name),
            'procurador_id' => function () {
                return User::factory()->create()->id;
            },
            'estagiario_id' => function () {
                return User::factory()->create()->id;
            },
            'assessor_id' => function () {
                return User::factory()->create()->id;
            },
            'tipo_meio_id' => function () {
                return Meio::factory()->create()->id;
            }
        ];
    }
}

<?php
namespace Database\Factories;

use App\Models\Processo;
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
            'numero_judicial' => $faker->randomNumber(4),
            'numero_alerj' => $faker->randomNumber(4),
            'tribunal_id' => function () {
                return factory(\App\Models\Processo::class)->create()->id;
            },
            'vara' => only_letters_and_space($faker->name), //'origem_complemento' => only_letters_and_space($faker->name),
            'data_distribuicao' => $faker->date('Y-m-d h:m:i'),
            'acao_id' => function () {
                return factory(\App\Models\Acao::class)->create()->id;
            },
            'relator_id' => function () {
                return factory(\App\Models\Juiz::class)->create()->id;
            },
            'apensos_obs' => only_letters_and_space($faker->name),
            'juiz_id' => function () {
                return factory(\App\Models\Juiz::class)->create()->id;
            },
            'autor' => only_letters_and_space($faker->name),
            'reu' => only_letters_and_space($faker->name),
            'objeto' => only_letters_and_space($faker->name),
            'ementa' => only_letters_and_space($faker->name),
            'merito' => only_letters_and_space($faker->name),
            'liminar' => only_letters_and_space($faker->name),
            'recurso' => only_letters_and_space($faker->name),
            'procurador_id' => function () {
                return factory(\App\Models\User::class)->create()->id;
            },
            'estagiario_id' => function () {
                return factory(\App\Models\User::class)->create()->id;
            },
            'assessor_id' => function () {
                return factory(\App\Models\User::class)->create()->id;
            },
            'tipo_meio_id' => function () {
                return factory(\App\Models\Meio::class)->create()->id;
            }
        ];
    }
}

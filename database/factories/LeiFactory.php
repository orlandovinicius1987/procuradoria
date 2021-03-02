<?php
namespace Database\Factories;

use App\Models\Lei;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Data\Repositories\NiveisFederativos as NiveisFederativosRepository;
use App\Data\Repositories\TiposLeis as TiposLeisRepository;
use Illuminate\Support\Str;

class LeiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lei::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_lei' =>
                (string) $this->faker->randomNumber(4) .
                '/' .
                (string) $this->faker->randomNumber(4),
            'autor' => only_letters_and_space($this->faker->name),
            'assunto' => only_letters_and_space($this->faker->name),
            'link' => only_letters_and_space($this->faker->name),
            'artigo' => (string) $this->faker->randomNumber(2),
            'paragrafo' => (string) $this->faker->randomNumber(2),
            'inciso' => (string) $this->faker->randomNumber(2),
            'alinea' => (string) $this->faker->randomNumber(2),
            'item' => (string) $this->faker->randomNumber(2),
            'nivel_federativo_id' => app(
                NiveisFederativosRepository::class
            )->randomElement()->id,
            'tipo_lei_id' => app(TiposLeisRepository::class)->randomElement()
                ->id
        ];
    }
}

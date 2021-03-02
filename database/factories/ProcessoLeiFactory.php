<?php
namespace Database\Factories;

use App\Models\ProcessoLei;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Data\Repositories\Processos as ProcessosRepository;
use App\Data\Repositories\Leis as LeisRepository;
use Illuminate\Support\Str;

class ProcessoLeiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProcessoLei::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'processo_id' => app(ProcessosRepository::class)->randomElement()
                ->id,
            'lei_id' => app(LeisRepository::class)->randomElement()->id
        ];
    }
}

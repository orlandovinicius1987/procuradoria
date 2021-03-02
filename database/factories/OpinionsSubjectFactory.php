<?php
namespace Database\Factories;

use App\Models\OpinionsSubject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;

class OpinionsSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpinionsSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'opinion_id' => app(OpinionsRepository::class)->randomElement()->id,
            'subject_id' => app(
                OpinionSubjectsRepository::class
            )->randomElement()->id
        ];
    }
}

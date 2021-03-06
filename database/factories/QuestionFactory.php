<?php

namespace Database\Factories;

use App\Models\{Question, Answer, Test};
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $seq=0;
        return [
            'test_id' => Test::factory(),
            'question' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'sequence_number' => $seq++,
        ];
    }
}

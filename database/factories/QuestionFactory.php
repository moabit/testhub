<?php

namespace Database\Factories;

use App\Models\{Question, Answer};
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
        return [
            'question' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'sequence_number' => 1
        ];
    }

    public function textQuestion()
    {
        return $this->state(function (array $attributes) {
            return [
                'answers' => function () {
                    return Answer::factory()->correctAnswer();
                }
            ];
        });
    }

    public function ordinaryQuestion()
    {
        return $this->state(function () {
            return [
                'account_status' => 3
            ];
        });
    }

    public function severalAnswersQuestion()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'suspended',
            ];
        });
    }
}

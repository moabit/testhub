<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_id' => Question::factory(),
            'answer' => $this->faker->word()
        ];
    }

    public function correctAnswer()
    {
        return $this->state(function () {
            return [
                'is_correct' => true
            ];
        });
    }

    public function wrongAnswer()
    {
        return $this->state(function () {
            return [
                'is_correct' => false
            ];
        });
    }
}

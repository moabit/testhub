<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }

    public function basicTest (int $randomNumberOfQuestions)
    {
        return $this->state(function (array $attributes) {
            return [
                'questions' => function (array $attributes) {
                    return Question::factory()->count(3);
                },
            ];
        });
    }
}

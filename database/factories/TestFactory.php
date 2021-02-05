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
            'title' => mb_convert_case($this->faker->word(), MB_CASE_TITLE, 'UTF-8'),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }
}

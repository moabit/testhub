<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Question;


use App\Models\Tag;
use App\Services\GradeCalculator;
use Database\Factories\AnswerFactory;
use Faker\Provider\Address;
use Faker\Provider\Internet;
use App\Services\Strategies\{GradeTextQuestionStrategy,
    GradeOrdinaryQuestionStrategy,
    GradeQuestionsWithSeveralAnswerStrategy
};
use App\DTO\CompletedTestData\CompletedTestData;
use App\Models\Test;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Support\Facades\Request;

class GradeCalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public GradeCalculator $gradeCalculator;


    public function setUp(): void
    {
        parent::setUp();
        $this->gradeCalculator = new GradeCalculator(new GradeOrdinaryQuestionStrategy(),
            new GradeQuestionsWithSeveralAnswerStrategy(),
            new GradeTextQuestionStrategy());
    }

    public function testGetGrade()
    {
        $test = Test::factory()
            ->has(Question::factory()->has(Answer::factory()->count(3)->wrongAnswer())->has(Answer::factory()->correctAnswer()))
            ->has(Question::factory()->has(Answer::factory()->count(3)->wrongAnswer())->has(Answer::factory()->count(2)->correctAnswer()))
            ->has(Question::factory()->has(Answer::factory()->correctAnswer()))
            ->create();

        $input = ['questions' => [
            19 => ['id' => (string)$test->questions[0]->id, 'answers' => [(string)$test->questions[0]->getCorrectAnswer()->id]],
            20 => ['id' => (string)$test->questions[1]->id, 'answers' => $test->questions[1]->getCorrectAnswer()->map(function ($a) {
                return (string)$a->id;
            })->values()->toArray()],
            30 => ['id' => (string)$test->questions[2]->id, 'answers' => [$test->questions[2]->getCorrectAnswer()->answer]]
        ]];
        $this->assertEquals(3, $this->gradeCalculator->getGrade(new CompletedTestData($input), $test));

        $wrongInput = ['questions' => [
            19 => ['id' => (string)$test->questions[0]->id, 'answers' => ['33']],
            20 => ['id' => (string)$test->questions[1]->id, 'answers' => ['1','2']],
            30 => ['id' => (string)$test->questions[2]->id, 'answers' => ['wrongAnswer']]
        ]];
        $this->assertEquals(0, $this->gradeCalculator->getGrade(new CompletedTestData($wrongInput), $test));
        $test->delete();


    }

}

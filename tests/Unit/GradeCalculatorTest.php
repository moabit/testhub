<?php

namespace Tests\Unit;

use App\Models\Question;


use App\Services\GradeCalculator;
use App\Services\Strategies\{GradeTextQuestionStrategy,
    GradeOrdinaryQuestionStrategy,
    GradeQuestionsWithSeveralAnswerStrategy
};
use App\DTO\CompletedTestData\CompletedTestData;
use App\Models\Test;
use Tests\TestCase;

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

    function testGetGrade()
    {
        $d = Question::factory();
        dd($d->id
        );
        $input = ['questions' => [
            ['id' => '1', 'answers' => ['11']],
            ['id' => '2', 'answers' => ['12', '13']],
            ['id' => '3', 'answers' => ['Correct']]
        ]
        ];


        $this->assertTrue(true);
    }
}

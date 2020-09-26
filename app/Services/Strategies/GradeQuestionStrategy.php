<?php


namespace App\Services\Strategies;

use App\Models\Question;
use App\DTO\CompletedTestData\CompletedQuestionData;

abstract class GradeQuestionStrategy
{
    public function getGrade(Question $question, CompletedQuestionData $answer): int
    {

    }
}

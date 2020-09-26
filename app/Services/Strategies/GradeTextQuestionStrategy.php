<?php


namespace App\Services\Strategies;


use App\Models\Question;
use  App\DTO\CompletedTestData\CompletedQuestionData;

class GradeTextQuestionStrategy extends GradeQuestionStrategy
{
    public function getGrade(Question $question, CompletedQuestionData $answer):int
    {
        if ($question->getCorrectAnswer()->answer==$answer->answers[0]) {
            return 1;
        };
        return 0;
    }
}

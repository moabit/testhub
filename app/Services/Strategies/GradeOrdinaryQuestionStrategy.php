<?php


namespace App\Services\Strategies;
use App\DTO\CompletedTestData\CompletedQuestionData;
use App\Models\Question;


class GradeOrdinaryQuestionStrategy
{
    public function getGrade(Question $question, CompletedQuestionData $answer):int
    {
        if ($question->getCorrectAnswer()->id == $answer->answers[0]) {
            return 1;
        }
        return 0;
    }
}

<?php


namespace App\Services\Strategies;
use App\Models\Question;


class GradeOrdinaryQuestionStrategy
{
    public function getGrade(Question $question, array $answer):float
    {
        $correctAnswer = $question->answers->where('is_correct', true)->first();
        if ($correctAnswer->answer == $answer[0]) {
            return $question->points;
        }
        return 0;
    }
}

<?php


namespace App\Services\Strategies;

use App\Exceptions\AnswerSubmissionException;
use App\Models\Question;

class GradeQuestionsWithSeveralAnswerStrategy
{
    public function getGrade(Question $question, array $userAnswer): float
    {
        $points = 0;
        if (count($userAnswer) > $question->numberOfAcceptedAnswers) {
            throw new AnswerSubmissionException('User can submit only ' . $question->numberOfAcceptedAnswers . ' for this question');
        }
        $question->answers->where('is_correct', true)->map(
            function ($answer) use (&$points, $userAnswer, $question) {
                if (in_array($answer->answer, $userAnswer)) {
                    $points += $question->getPointsForOneCorrectAnswer();
                }
            });
        return $points;
    }
}

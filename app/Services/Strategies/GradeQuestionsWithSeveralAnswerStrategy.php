<?php


namespace App\Services\Strategies;

use App\Exceptions\AnswerSubmissionException;
use App\Models\Question;
use App\DTO\CompletedTestData\CompletedQuestionData;

class GradeQuestionsWithSeveralAnswerStrategy
{
    public function getGrade(Question $question, CompletedQuestionData $userAnswer): int
    {

        /*
        if (count($userAnswer) > $question->numberOfAcceptedAnswers) {
            throw new AnswerSubmissionException('User can submit only ' . $question->numberOfAcceptedAnswers . ' for this question');
        }
        */
        $totalPoints = $question->getCorrectAnswer()->count();
        $points = 0;
        $question->getCorrectAnswer()->map(
            function ($correctAnswer) use (&$points, $userAnswer, $question) {
                if (in_array($correctAnswer->id, $userAnswer->answers)) {
                    $points += 1;
                }
            });
        if ($totalPoints !== count($userAnswer->answers) || $points !==$totalPoints  ) {
            return 0;
        }
        return 1;

    }
}

<?php


namespace App\Services;

use App\DTO\CompletedTestData\CompletedTestData;
use App\Services\Strategies\{GradeOrdinaryQuestionStrategy,
    GradeQuestionsWithSeveralAnswerStrategy,
    GradeTextQuestionStrategy
};
use App\Models\Test;

class GradeCalculator
{
    protected GradeOrdinaryQuestionStrategy $gradeOrdinaryQuestionStrategy;
    protected GradeQuestionsWithSeveralAnswerStrategy $gradeQuestionsWithSeveralAnswerStrategy;
    protected GradeTextQuestionStrategy $gradeTextQuestionStrategy;

    public function __construct(GradeOrdinaryQuestionStrategy $gradeOrdinaryQuestionStrategy, GradeQuestionsWithSeveralAnswerStrategy $gradeQuestionsWithSeveralAnswerStrategy, GradeTextQuestionStrategy $gradeTextQuestionStrategy)
    {
        $this->gradeOrdinaryQuestionStrategy = $gradeOrdinaryQuestionStrategy;
        $this->gradeQuestionsWithSeveralAnswerStrategy = $gradeQuestionsWithSeveralAnswerStrategy;
        $this->gradeTextQuestionStrategy = $gradeTextQuestionStrategy;
    }

    public function getGrade(CompletedTestData $completedTest, Test $testWithAnswers): int
    {
        $points = 0;
        foreach ($completedTest->questions as $userAnswer) {
            $questionWithAnswers = $testWithAnswers->questions->find($userAnswer->id);
            switch ($questionWithAnswers) {
                case $questionWithAnswers->isTextQuestion() == true:
                    $points += $this->gradeTextQuestionStrategy->getGrade($questionWithAnswers, $userAnswer);
                    break;
                case $questionWithAnswers->hasOnlyOneCorrectAnswer() == false:
                    $points += $this->gradeQuestionsWithSeveralAnswerStrategy->getGrade($questionWithAnswers, $userAnswer);
                    break;
                case $questionWithAnswers->hasOnlyOneCorrectAnswer() == true:
                    $points += $this->gradeOrdinaryQuestionStrategy->getGrade($questionWithAnswers, $userAnswer);
                    break;
            }
        }
        return $points;
    }

    public function getStatus(bool $deadline, int $grade,?int $passRate): string
    {
        $status = 'passed';
        if (!$deadline) {
            $status = 'timeElapsed';
        } elseif ($grade < $passRate) {
            $status = 'failed';
        }
        return $status;
    }


}

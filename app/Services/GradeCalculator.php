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

    /*
    public function getGrade(CompletedTestData $answers, Test $testWithAnswers): float
    {
        $points = 0;
        foreach ($testWithAnswers->questions as $question) {
            switch ($question) {
                case $question->isTextQuestion() == true:
                  $this->gradeTextQuestionStrategy($question, $)
                    break;
                default:
                    $points += $this->gradeOrdinaryQuestionStrategy->getGrade($question, $answers['question_' . $question->id]);
                    break;
            }
        }
        return $points;
    }
    */

    public function getGradee(CompletedTestData $completedTest, Test $testWithAnswers)
    {
        $points = 0;
        foreach ($completedTest->questions as $userAnswer) {
            $questionWithAnswers = $testWithAnswers->questions->find($userAnswer->id);
            switch ($questionWithAnswers) {
                case $questionWithAnswers->isTextQuestion() == true:
                    echo "lol 1";
                    $points += $this->gradeTextQuestionStrategy->getGrade($questionWithAnswers, $userAnswer);
                    break;
                case $questionWithAnswers->hasOnlyOneCorrectAnswer() == false:
                    $points += $this->gradeQuestionsWithSeveralAnswerStrategy->getGrade($questionWithAnswers, $userAnswer);
                    echo "lol 2";
                    break;
                case $questionWithAnswers->hasOnlyOneCorrectAnswer() == true:
                    $points += $this->gradeOrdinaryQuestionStrategy->getGrade($questionWithAnswers, $userAnswer);
                    echo "lol 3";
                    break;
            }
        }
        return $points;
    }


}

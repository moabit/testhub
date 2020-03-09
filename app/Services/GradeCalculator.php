<?php


namespace App\Services;

use App\Services\Strategies\{GradeOrdinaryQuestionStrategy, GradeQuestionsWithSeveralAnswerStrategy};
use App\Models\Test;


class GradeCalculator
{
    protected $gradeOrdinaryQuestionStrategy;
    protected $gradeQuestionsWithSeveralAnswerStrategy;

    public function __construct(GradeOrdinaryQuestionStrategy $gradeOrdinaryQuestionStrategy, GradeQuestionsWithSeveralAnswerStrategy $gradeQuestionsWithSeveralAnswerStrategy)
    {
        $this->gradeOrdinaryQuestionStrategy = $gradeOrdinaryQuestionStrategy;
        $this->gradeQuestionsWithSeveralAnswerStrategy = $gradeQuestionsWithSeveralAnswerStrategy;
    }

    public function getGrade(array $answers, Test $testWithAnswers): float
    {
        $points = 0;
        foreach ($testWithAnswers->questions as $question) {
            switch ($question) {
                case $question->several_answers == true:
                    $points += $this->gradeQuestionsWithSeveralAnswerStrategy->getGrade($question, $answers['question_' . $question->id]);
                    break;
                default:
                    $points += $this->gradeOrdinaryQuestionStrategy->getGrade($question, $answers['question_' . $question->id]);
                    break;
            }
        }
        return $points;
    }




}

<?php


namespace App\Services\Strategies;
use App\Models\Question;

abstract class GradeQuestionStrategy
{
     public function getGrade(Question $question, array $answer) :float
    {

    }
}

<?php
declare(strict_types=1);

namespace App\DTO\CompletedTestData;

use App\DTO\CompletedTestData\CompletedQuestionData;
use App\DTO\DataTransferObject;


class CompletedTestData extends DataTransferObject
{
    public array $questions;

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->questions = array_values($this->questions);
        foreach ($this->questions as &$question) {
            $question = new CompletedQuestionData($question);
        }
    }
}

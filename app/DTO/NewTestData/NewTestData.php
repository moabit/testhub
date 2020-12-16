<?php


namespace App\DTO\NewTestData;

use App\DTO\DataTransferObject;
use App\DTO\NewTestData\NewQuestionData;

class NewTestData extends DataTransferObject
{
    public string $title;
    public string $description;
    public int $passRate;
    public $timeLimit;
    public array $tags;
    public array $questions;

    public function __construct(array $params)
    {
        parent::__construct($params);
        foreach ($this->questions as &$question) {
            $question = new NewQuestionData($question);
        }
    }
}

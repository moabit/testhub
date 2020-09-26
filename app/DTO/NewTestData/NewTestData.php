<?php
declare(strict_types=1);

namespace App\DTO;

use App\DTO\NewQuestionData;

class NewTestData extends DataTransferObject
{
    public string $title;
    public string $description;
    public int $passRate;
    public int $timeLimit;
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

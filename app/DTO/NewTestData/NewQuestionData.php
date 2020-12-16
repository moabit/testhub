<?php
declare(strict_types=1);


namespace App\DTO\NewTestData;


use App\DTO\DataTransferObject;
use App\DTO\NewTestData\NewAnswerData;

class NewQuestionData extends DataTransferObject
{
    public string $question;
    public array $answers;

    public function __construct(array $params)
    {
        parent::__construct($params);
        foreach ($this->answers as &$answer) {
            $answer = new NewAnswerData($answer);
        }
    }
}

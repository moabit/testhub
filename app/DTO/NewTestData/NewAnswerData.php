<?php
declare(strict_types=1);


namespace App\DTO\NewTestData;
use App\DTO\DataTransferObject;

class NewAnswerData extends DataTransferObject
{
    public string $answer;
    public bool $isCorrect;

    public function __construct(array $params)
    {
        parent::__construct($params);
    }
}

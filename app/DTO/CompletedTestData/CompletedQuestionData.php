<?php


namespace App\DTO\CompletedTestData;
use App\DTO\DataTransferObject;

class CompletedQuestionData extends DataTransferObject
{
    public int $id;
    public array $answers;

    public function __construct(array $params)
    {
        parent::__construct($params);
    }
}

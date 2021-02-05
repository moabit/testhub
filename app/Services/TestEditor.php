<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\CreateNewTestRequest;
use Illuminate\Support\Facades\DB;
use App\Models\{Test, Question, Answer, Tag};
use Illuminate\Support\Collection;
use App\DTO\NewTestData\NewTestData;
use App\DTO\NewTestData\NewAnswerData;
use App\DTO\NewTestData\NewQuestionData;
use Illuminate\Support\Facades\Hash;

class TestEditor
{
    public function addNewTest(NewTestData $newTestData): Test
    {
        DB::beginTransaction();
        $test = Test::create(['title' => $newTestData->title,
            'description' => $newTestData->description,
            'pass_rate' => $newTestData->passRate,
            'time_limit' => $newTestData->timeLimit,
        ]);
        foreach ($newTestData->tags as $tag) {
            $this->addNewTag($test, $tag);
        }
        foreach ($newTestData->questions as $index => $question) {
            $this->addNewQuestion($test, $question, $index);
        }
        DB::commit();
        return $test;
    }

    private function addNewQuestion(Test $test, NewQuestionData $newQuestion, int $index)
    {
        $question = $test->questions()->create(
            ['question' => $newQuestion->question,
                'sequence_number' => $index]);
        foreach ($newQuestion->answers as $answer) {
            $this->addNewAnswer($question, $answer);
        }
    }

    private function addNewAnswer(Question $question, NewAnswerData $answer)
    {
        $question->answers()->create(
            ['answer' => $answer->answer, 'is_correct' => $answer->isCorrect]
        );
    }

    private function addNewTag(Test $test, string $tag)
    {
        $test->tags()->create(['title' => $tag]);
    }
}

<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TestSubmitRequest;
use Illuminate\Support\Facades\DB;
use App\Models\{Test, Question, Answer, Tag};
use Illuminate\Support\Collection;
use App\DTO\NewTestData;
use App\DTO\NewAnswerData;
use App\DTO\NewQuestionData;
use Illuminate\Support\Facades\Hash;

class TestEditor
{
    public function addNewTest(): Test
    {
     $quest=[['question' => 'vopros', 'answers' => [['answer' => 'otvet', 'isCorrect' => true]]]];
       $testik=['title' => 'nazvanie', 'questions' => $quest, 'description' => 'opisanie', 'passRate' => 4, 'timeLimit' => 4, 'tags' => ['tag']];
     //  TestSubmitRequest $request $request->input('test')
        $newTestData = new NewTestData($testik);
        DB::beginTransaction();
        $test = Test::create(['title' => $newTestData->title,
            'description' => $newTestData->description,
            'minimum_score' => $newTestData->passRate,
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
                'is_compulsory' => true,
                'points' => 10,
                'type' => 'choose',
                'several_answers' => true,
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestSubmitRequest;
use Illuminate\Http\{Request, Response};
use Illuminate\View\View;
use App\Models\{Test, TestResult, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\{GradeCalculator, TestEditor, TimeTracker};
use App\Repositories\Eloquent\{TestRepository, TestResultRepository};
use App\DTO\NewTestData;
use App\DTO\CompletedTestData\CompletedTestData;


class TestController extends Controller
{
    protected GradeCalculator $gradeCalculator;
    protected TestRepository $testRepository;
    protected TestResultRepository $testResultRepository;
    protected TestEditor $testEditor;
    protected TimeTracker $timeTracker;

    public function __construct(GradeCalculator $gradeCalculator,
                                TestRepository $testRepository,
                                TestResultRepository $testResultRepository,
                                TestEditor $testEditor,
                                TimeTracker $timeTracker)
    {
        $this->gradeCalculator = $gradeCalculator;
        $this->testRepository = $testRepository;
        $this->testResultRepository = $testResultRepository;
        $this->testEditor = $testEditor;
        $this->timeTracker = $timeTracker;
    }

    public function startTest(int $testId, Request $request, Response $response)
    {
        $test = $this->testRepository->getTestById($testId);
        $this->timeTracker->start($request, $test->time_limit, $test->id);
        return redirect()->route('questions', [$test]);
    }

    public function submitAnswers(int $testId, Request $request, Response $response)
    {
        $test = $this->testRepository->getTestByIdWithQuestionsAndAnswers($testId);
        $deadline = $this->timeTracker->checkDeadline($request, $test->id, $test->time_limit);
        $timeSpent =$this->timeTracker->stop($request, $test->id);
        $testDto = new CompletedTestData($request->input('test'));
        $grade = $this->gradeCalculator->getGrade($testDto, $test);
        $status=$this->gradeCalculator->getStatus($deadline,$grade,$test->pass_rate);
        $this->testResultRepository->createTestResult($testId, $grade);
        $test->increment('attempts');
        return redirect()->route('result', [$test])->with(['result'=> $grade,'testTitle'=> $test->title,
            'status'=>$status, 'timeSpent'=>date('H:i:s',$timeSpent),'questionsCount'=>$test->questions->count()]);
    }

    public function addNewTest(TestSubmitRequest $request, Response $response)
    {
        //$questions = [['question' => 'vopros', 'answers' => [['answer' => 'otvet', 'isCorrect' => true]]]];
        //  $lolk = new NewTestData(['title' => 'nazvanie', 'questions' => $questions, 'description' => 'opisanie', 'passRate' => 4, 'timeLimit' => 4, 'tags' => ['tag']]);
        $lol = $this->testEditor->addNewTest();
        dd($lol);
        $newTest = $request->input('test');
        $newQuestions = $request->input('questions');
        $correctAnswers = $request->input('correctAnswers');
        $test = Test::create(['title' => $newTest['title'],
            'description' => $newTest['description'],
            'minimum_score' => $newTest['minimum']]);
        foreach ($newQuestions as $newQuestion) {
            $question = $test->questions()->create(['question' => $newQuestion[0],
                'is_compulsory' => true,
                'points' => 10,
                'type' => 'choose',
                'several_answers' => true,
                'sequence_number' => 1]);
            for ($i = 0; $i < count($newQuestion['answers']); $i++) {
                $isCorrect = (in_array($i, $correctAnswers['question' . $question->sequence_number])) ? true : false;
                $question->answers()->create(['answer' => $newQuestion['answers'][$i],
                    'is_correct' => $isCorrect]);
            }
        }
    }
}

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
        $deadline = null;

        if ($test->time_limit) { //а работает ли?
            $deadline = strtotime('now') + strtotime($test->time_limit);
            //nested array
           // $this->timeTracker->setDeadline($request,$test->time_limit, $test->id);
        }

        session()->put('started_tests.' . $test->id, $deadline);

        return redirect()->route('questions', [$test],$test);
    }

    public function submitAnswers(int $testId, Request $request, Response $response)
    {
        $test = $this->testRepository->getTestByIdWithQuestionsAndAnswers($testId);
        //  $user = User::getUser() Non-static method App\Models\User::getUser() should not be called statically  ;
        $lolz = new CompletedTestData($request->input('test'));
        //  if (count($userAnswers) > $test->questions->count()) {
        //    throw new AnswerSubmissionException('Too much answers submitted');
        //}
        $grade = $this->gradeCalculator->getGradee($lolz, $test);
        dd($grade);
        $this->testResultRepository->createTestResult($testId, $grade, $user);
        return redirect()->route('result', [$test])->with('result', $grade)->with('testTitle', $test->title);
        ///overalpoints= user_points/points *100 и сократить к до долей десятка
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

<?php

namespace App\Http\Controllers;

use App\DTO\NewTestData\NewTestData;
use App\Http\Requests\CreateNewTestRequest;
use Illuminate\Http\{Request, Response};
use Illuminate\View\View;
use App\Models\{Test, TestResult, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\{GradeCalculator, TestEditor, TimeTracker};
use App\Repositories\Eloquent\{TestRepository, TestResultRepository};
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
        $timeSpent = $this->timeTracker->stop($request, $test->id);
        dd($request->input('test'));
        $testDto = new CompletedTestData($request->input('test'));
        $grade = $this->gradeCalculator->getGrade($testDto, $test);
        $status = $this->gradeCalculator->getStatus($deadline, $grade, $test->pass_rate);
        $this->testResultRepository->createTestResult($testId, $grade, Auth::id(), $timeSpent);
        return redirect()->route('result', [$test])->with(['result' => $grade, 'testTitle' => $test->title,
            'status' => $status, 'timeSpent' => date('H:i:s', $timeSpent), 'questionsCount' => $test->questions->count()]);
    }

    public function addNewTest(CreateNewTestRequest $request, Response $response)
    {
        dd("lol");
        $this->testEditor->addNewTest(new NewTestData($request->all()));
        dd("win");
    }

    public function deleteTest(Request $request, Response $response)
    {
        $test = $this->testRepository->getTestByIdWithQuestionsAndAnswers($request->input('id'));
    }

    public function editTest()
    {

    }

    public function showEdit()
    {

    }
}

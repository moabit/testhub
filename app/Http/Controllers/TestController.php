<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use Illuminate\View\View;
use App\Models\{Test, TestResult, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Services\GradeCalculator;
use App\Repositories\Eloquent\{TestRepository, TestResultRepository};

class TestController extends Controller
{
    protected $gradeCalculator;

    protected $testRepository;

    protected $testResultRepository;

    public function __construct(GradeCalculator $gradeCalculator, TestRepository $testRepository, TestResultRepository $testResultRepository)
    {
        $this->gradeCalculator = $gradeCalculator;
        $this->testRepository = $testRepository;
        $this->testResultRepository = $testResultRepository;
    }

    public function startTest(int $testId, Request $request, Response $response)
    {
        $test = $this->testRepository->getTestById($testId);
        $deadline = null;
        if ($test->time_limit) { //а работает ли?
            $deadline = strtotime('now') + strtotime($test->time_limit);
            //nested array
        }
        session()->put('started_tests.' . $test->id, $deadline);
        return redirect()->route('questions', [$test]);
    }

    public function submitAnswers(int $testId, Request $request, Response $response)
    {
        $test = $this->testRepository->getTestByIdWithQuestionsAndAnswers($testId);
        $user = User::getUser();
        $userAnswers = $request->input();
        //  if (count($userAnswers) > $test->questions->count()) {
        //    throw new AnswerSubmissionException('Too much answers submitted');
        //}
        $grade = $this->gradeCalculator->getGrade($userAnswers, $test);
        $this->testResultRepository->createTestResult($testId, $grade, $user);
        return redirect()->route('result', [$test])->with('result', $grade)->with('testTitle', $test->title);
        ///overalpoints= user_points/points *100 и сократить к до долей десятка
    }

}

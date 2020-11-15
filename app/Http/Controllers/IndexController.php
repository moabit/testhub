<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Eloquent\TestRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Test;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    protected $testRepository;
    protected $userRepository;

    public function __construct(TestRepository $testRepository, UserRepository $userRepository)
    {
        $this->testRepository = $testRepository;
        $this->userRepository = $userRepository;
    }

    public function showIndexPage(User $user)
    {
        return view('index')->with('tests', $this->testRepository->getTopTests());
    }

    public function showTestPage(Request $request)
    {
        return view('test_description')->with('test', $this->testRepository->getTestById(($request->route('id'))));
    }

    public function showQuestions(int $id): View
    {
        $test = Test::with('questions.answers')->findOrFail($id);

        return view('questions', ['questions' => $test->questions->sortBy('sequence_number'), 'test' => $test]);
    }

    public function showResult(int $id): View
    {
        return view('result');
    }

    public function showAddTest(): View
    {
        return view('add_new_test');
    }

    public function showTest()
    {
        return view('test');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function showStats()
    {
        $testResults = $this->userRepository->getOrderedTestResultsByUserId((Auth::user()->id));
        return view('stats', ['testResults' => $testResults]);
    }

    public function showMyTests()
    {
        $createdTests = $this->userRepository->getCreatedTestsByUserId((Auth::user()->id));

        return view('my_tests', ['tests' => $createdTests]);
    }
}

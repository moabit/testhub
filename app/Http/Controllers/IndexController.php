<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Eloquent\TestRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Test;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;



class IndexController extends Controller
{
    protected $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function showIndexPage(User $user)
    {
       return view('index')->with('tests', $this->testRepository->getTopTests());

    }

    public function showTestPage(Request $request)
    {

        return view('test')->with('test', $this->testRepository->getTestById(($request->route('id'))));
    }

    public function showQuestions(int $id): View
    {
        $test = Test::with('questions.answers')->findOrFail($id);
        dd(session()->all());
        return view('questions', ['questions' => $test->questions->sortBy('sequence_number')]);
    }

    public function showResult(int $id): View
    {
        return view('result');
    }


}

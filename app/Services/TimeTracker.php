<?php


namespace App\Services;

use Illuminate\Http\Request;

class TimeTracker
{
    protected int $currentTime;
    protected int $deadline;
    /*
    public function __construct(int $currentTime, int $deadline)
    {
        $this->currentTime = $currentTime;
        $this->deadline = $deadline;
    }
    */
    public function timePassed(): int
    {

    }

    public function hasDeadlineExpired(): bool
    {

    }

    public function setDeadline(Request $request, int $timeLimit, int $testId)
    {
        $deadline = strtotime('now') + strtotime($timeLimit);
        $arr = ['deadline' => $deadline];
        $request->session()->put('tests.'.$testId, $arr);
       // dd($request);
    }
}

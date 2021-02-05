<?php


namespace App\Services;

use Illuminate\Http\Request;

class TimeTracker
{
    public function timePassed(Request $request, int $testId): int
    {
        return $request->session()->get('startedTests.' . $testId);
    }

    public function checkDeadline(Request $request, int $testId, ?int $timeLimit): bool
    {
        if ($timeLimit) {
            $timeStarted = $request->session()->get('startedTests.' . $testId);
            $deadline = $timeStarted + $timeLimit * 60;
            if (strtotime('now') > $deadline) {
                return false;
            }
        }
        return true;
    }

    public function start($request, int $testId): void
    {
        if (!$request->session()->get('startedTests.' . $testId)) {
            //$deadline = $timeLimit ? strtotime('now') + $timeLimit * 60 : null;
            $request->session()->put('startedTests.' . $testId, strtotime('now'));
        }
    }

    public function stop(Request $request, int $testId): int
    {
        $timeSpent = strtotime('now') - $request->session()->get('startedTests.' . $testId);
        $request->session()->forget('startedTests.' . $testId);
        return $timeSpent;
    }
}

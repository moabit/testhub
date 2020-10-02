<?php


namespace App\Repositories\Eloquent;

use App\Models\TestResult;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;


class TestResultRepository extends Repository
{
    public function createTestResult(int $testId, int $grade): TestResult
    {
        /*
        if ($user->isAnonymous()) {
            return TestResult::create(['test_id' => $testId, 'score' => $grade, 'anonymous_token' => $user->anonymous_token]);
        }
        */
        return TestResult::create(['test_id' => $testId, 'score' => $grade]);
    }
}

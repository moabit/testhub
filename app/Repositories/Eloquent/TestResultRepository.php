<?php


namespace App\Repositories\Eloquent;

use App\Models\TestResult;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;


class TestResultRepository extends Repository
{
    public function createTestResult(int $testId, int $grade, ?int $userId, int $timeSpent): TestResult
    {
        if ($userId) {
            return TestResult::create(['test_id' => $testId, 'score' => $grade, 'user_id' => $userId, 'time_spent' => $timeSpent]);
        }
        return TestResult::create(['test_id' => $testId, 'score' => $grade, 'time_spent' => $timeSpent]);
    }
}

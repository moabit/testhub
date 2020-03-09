<?php


namespace App\Repositories\Eloquent;

use App\Models\TestResult;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;


class TestResultRepository extends Repository
{
    public function createTestResult(int $testId, float $grade, string $guestToken = null): TestResult
    {
        return TestResult::create(['test_id' => $testId, 'score' => $grade, 'guest_token' => $guestToken]);
    }
}

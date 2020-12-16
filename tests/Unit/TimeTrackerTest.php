<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\TimeTracker;

class TimeTrackerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public TimeTracker $timeTracker;

    public function setUp(): void
    {
        $this->timeTracker = new TimeTracker();
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
}

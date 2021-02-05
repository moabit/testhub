<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use App\Services\TimeTracker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

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
        parent::setUp();
        $this->timeTracker = new TimeTracker();
    }

    public function testStartTimeTracker()
    {
        $req = Request::create('/', 'GET');
        $req->setLaravelSession(app('session.store'));

        $now = strtotime('now');
        $notNow = strtotime('+1 hour');

        $this->timeTracker->start($req, 1);
        $this->assertEquals($now, $req->session()->get('startedTests.1'));
        $this->assertNotEquals($notNow, $req->session()->get('startedTests.1'));

        $this->timeTracker->stop($req, 1);

    }

    public function testCheckDeadline()
    {

        $req = Request::create('/', 'GET');
        $req->setLaravelSession(app('session.store'));

        $this->timeTracker->start($req, 1);

        $this->assertTrue($this->timeTracker->checkDeadline($req, 1, null));
        $this->assertTrue($this->timeTracker->checkDeadline($req, 1, 20));

        $req->session()->put('startedTests.1', strtotime('-10 minutes'));


        $this->assertFalse($this->timeTracker->checkDeadline($req, 1, 5));
        $this->timeTracker->stop($req, 1);

    }

    public function testStopTimeTracker ()
    {
        $req = Request::create('/', 'GET');
        $req->setLaravelSession(app('session.store'));

        $this->timeTracker->start($req, 1);
        $this->timeTracker->stop($req, 1);

        $this->assertNull($req->session()->get('startedTests.1'));

    }
}

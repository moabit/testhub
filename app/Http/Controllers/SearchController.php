<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TestRepository;

class SearchController extends Controller
{
    protected $testRepository;

    public function __construct($testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function search(Request $request)
    {
        $limit = 10;

    }
}

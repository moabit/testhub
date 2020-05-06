<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TestRepository;
use App\Services\SphinxSearch;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $sphinxSearch;

    public function __construct(SphinxSearch $sphinxSearch)
    {
        $this->sphinxSearch = $sphinxSearch;
    }

    public function searchByTestTitle(Request $request)
    {
        $currentPage = isset($request['page']) ? $request['page'] : 1;
        $limit = 10; // search results on a single page
        $offset = ($currentPage - 1) * $limit;
        dd(DB::connection('sphinx')->getPDO());
       // $tests = $this->sphinxSearch->search($request['testTitle'], $offset, $limit);
    }
}

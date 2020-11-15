<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\TestRepository;
use App\Services\SphinxSearch;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use App\Repositories\Eloquent\TagRepository;
use App\Models\Tag;

class SearchController extends Controller
{
    protected $sphinxSearch;
    protected $tagRepository;
    protected $testRepository;

    public function __construct(SphinxSearch $sphinxSearch,
                                TagRepository $tagRepository,
                                TestRepository $testRepository)
    {
        $this->sphinxSearch = $sphinxSearch;
        $this->tagRepository = $tagRepository;
        $this->testRepository = $testRepository;
    }

    public function search(Request $request, $tag = null)
    {
        if ($tag || (bool)$request->input('isTagSearch')) {
            $tag =  $tag ?? (string) $request->input('searchInput');
            $tests = $this->tagRepository->findTestByTag($tag);
            $title = null;
        } else {
            $title = (string) $request->input('searchInput');
            $tests = $this->testRepository->findTestsByIds($this->sphinxSearch->searchByTitle($title));
        }
        return view('search', ['tests' => $tests, 'tag'=>$tag,'title'=>$title]);
    }
}

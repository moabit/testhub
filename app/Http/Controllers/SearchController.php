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

    public function __construct(SphinxSearch $sphinxSearch, TagRepository $tagRepository)
    {
        $this->sphinxSearch = $sphinxSearch;
        $this->tagRepository = $tagRepository;
    }

    public function searchByTestTitle(Request $request)
    {
        $currentPage = isset($request['page']) ? $request['page'] : 1;
        $limit = 10; // search results on a single page
        $offset = ($currentPage - 1) * $limit;
        dd(DB::connection('sphinx')->getPDO());
        // $tests = $this->sphinxSearch->search($request['testTitle'], $offset, $limit);
    }

    public function getTestsByTag(Request $request)
    {
        //$offset = $request->input('offset') ? $request->input('offset') : 0;
        // $limit = 50;
        $inputTag = $request->route('tag');
        $tag = Tag::where('title', $inputTag)->first();
        if (isset($tag)) {
            $tests = $tag->tests()->orderBy('views', 'desc')->skip(0)->take(50)->get();
        }
        return view ('search',['tag'=>$tag,'tests'=>$tests]);
    }


}

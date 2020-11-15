<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Repository;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Test;

class TagRepository extends Repository
{
    public function getTagById(string $id): Tag
    {
        return Tag::findOrFail($id);
    }

    public function findTestByTag(string $tag): LengthAwarePaginator
    {
        return Tag::where('title', $tag)->firstOrNew([])->tests()
         ->withCount('testResults')->orderBy('test_results_count','desc')->paginate(1);
    }
}

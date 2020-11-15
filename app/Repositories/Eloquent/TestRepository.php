<?php


namespace App\Repositories\Eloquent;

use App\{Models\Test, Repositories\Repository, Exceptions\RelatedModelsNotFoundException};
use Illuminate\{Database\Eloquent\Collection, Pagination\LengthAwarePaginator, Support\Facades\Config};
use App\Services\SphinxSearch;


class TestRepository extends Repository
{
    protected $sphinxSearch;

    public function __construct(SphinxSearch $sphinxSearch)
    {
        $this->sphinxSearch = $sphinxSearch;
    }

    public function getTestById(string $id): Test
    {
        return Test::findOrFail($id);
    }

    public function getTopTests()
    {

        return Test::withCount('testResults')->orderBy('test_results_count','desc')->limit(Config::get('constants.options.testsOnPage'))->get();
    }

    public function getTestByIdWithQuestionsAndAnswers(int $id): Test
    {
        return Test::with('questions.answers')->findOrFail($id);
    }

    public function findTest(string $match): ?Collection
    {

    }

    public function deleteTestById (int $id):void
    {

    }

    public function findTestsByIds (?array $ids):LengthAwarePaginator
    {
        return Test::whereIn('id', $ids)->paginate(1);
    }


}


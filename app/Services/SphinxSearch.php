<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Test;
use Illuminate\Support\Collection;

class SphinxSearch
{
    public function searchByTitle(string $testTitle): array
    {
        if ($testTitle == null) {
            return [];
        }
        return $this->toArray(DB::connection('sphinx')->select('SELECT id FROM index_tests, rt_tests
         WHERE MATCH(:testTitle) OPTION ranker=bm25',
            ['testTitle' => $testTitle]));
    }

    public function indexNewTest(int $testId, string $testTitle): void
    {
        DB::connection('sphinx')->insert('INSERT INTO rt_tests(id, title) VALUES(:testId, :testTitle)',
            ['testId' => $testId, 'testTitle' => $testTitle]);
    }

    public function deleteIndexedTest(int $testId): void
    {
        DB::connection('sphinx')->delete('DELETE FROM rt_tests WHERE id = :testId', ['testId' => $testId]);
    }
//Config::get('constants.options.testsOnPage')
    private function toArray(array $objects): array
    {
        $output = [];
        foreach ($objects as $object) {
            array_push($output, $object->id);
        }
        return $output;
    }

}

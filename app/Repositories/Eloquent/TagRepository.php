<?php


namespace App\Repositories\Eloquent;
use App\Repositories\Repository;
use App\Models\Tag;

class TagRepository extends Repository
{
    public function getTagById(string $id): Tag
    {
        return Tag::findOrFail($id);
    }
}

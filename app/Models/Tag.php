<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tests_tags', 'tag_id', 'test_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\RelatedModelsNotFoundException;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Tag,Question};

class Test extends Model
{
    public $timestamps = false;

    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tests_tags',
            'test_id', 'tag_id');
    }

    public function questions():HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestionsAttribute():Collection
    {
        $questions = $this->questions()->get();
        if ($questions->count() < 4) {
            throw new RelatedModelsNotFoundException('Test can\'t have less then four questions ');
        }
        return $questions;
    }

    public function getMaximumScoreAttribute():int
    {
        return $this->questions->sum('points');
    }


}

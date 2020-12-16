<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\RelatedModelsNotFoundException;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Tag, Question, TestResult, User};


class Test extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'pass_rate'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tests_tags',
            'test_id', 'tag_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getQuestionsAttribute(): Collection
    {
        return $this->questions()->get();
    }

    public function getTruncatedDescription()
    {
        $descriptionLength = 240;
        if (mb_strlen($this->description) < $descriptionLength) {
            return $this->description;
        }
        $truncated = substr($this->description, 0, $descriptionLength);
        return substr($truncated, 0, strrpos($truncated, ' ')) . '…';
    }

    public function getMaximumScoreAttribute(): int
    {
        return $this->questions->sum('points');
    }

    public function isCreatedByRegisteredUser(): bool
    {
        if ($this->user()->get()->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

}

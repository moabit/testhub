<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Exceptions\RelatedModelsNotFoundException;
use App\Models\Answer;


class Question extends Model
{
    public $timestamps = false;

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function getAnswersAttribute(): Collection
    {
        $answers = $this->answers()->get();
        if ($answers->count() < 2 && $this->type == 'choose') {
            throw new RelatedModelsNotFoundException('Multiple choice question can\'t have less then two possible answers ');
        } elseif ($answers->where('is_correct', true)->count() == 0) {
            throw new RelatedModelsNotFoundException('Correct answer is not found');
        }
        return $answers;
    }

    public function getPointsForOneCorrectAnswer ():float
    {
        return round($this->points / $this->numberOfAcceptedAnswers, 1);
    }

    public function getNumberOfAnswersAttribute(): int
    {
        return $this->answers->count();
    }

    public function getNumberOfAcceptedAnswersAttribute(): int
    {
        return $this->answers->where('is_correct', true)->count();
    }
}

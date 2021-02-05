<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TestResult extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $fillable = ['test_id', 'score', 'guest_token','user_id','time_spent'];

    public function test()
    {
        return $this->hasOne(Test::class,'id', 'test_id' );
    }
}

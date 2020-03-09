<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    public $timestamps = false;
    protected $fillable = ['test_id', 'score', 'guest_token'];

}

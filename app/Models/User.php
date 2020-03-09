<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\{Test, TestResult};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'anonymous_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function getUser(): User
    {
        switch (Auth::check()) {
            case true:
                $user = Auth::user();
            case false:
                if (Cookie::get('uniqueId')) {
                    $uniqueId = Cookie::get('uniqueId');
                    try {
                        $user = $this->getUserByUniqueId($uniqueId);
                    } catch (ModelNotFoundException $e) {
                        $user = $this->createAnonymous();
                    }
                }
            default:
                $user = $this->createAnonymous();
        }
        return $user;
    }
}

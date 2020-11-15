<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
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
        return $this->hasMany(Test::class,'created_by', 'id' );
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function getUser(): User
    {
        switch (Auth::check()) {
            case true:
                return Auth::user();
            case false:
                $userCookieToken = Cookie::get('uniqueId');
                if ($userCookieToken) {
                    try {
                        $user = User::where('anonymousToken', $userCookieToken)->firstOrFail();
                        return $user;
                    } catch (ModelNotFoundException $e) {
                        return $this->createAnonymousUser();
                    }
                } else {
                    return $this->createAnonymousUser();
                }
        }
    }

    public function isAnonymous(): bool
    {
        return $this->anonymous_token ? true : false;
    }

    private function createAnonymousUser(): void
    {
        $token = Str::random(20);
        Cookie::queue('anonymousToken', $token, 60 * 24 * 365);
    }

}

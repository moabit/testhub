<?php


namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Repository;


class UserRepository extends Repository
{
    public function getOrderedTestResultsByUserId (int $id)
    {
        return User::find($id)->testResults()->orderBy('created_at','desc')->get();
    }

    public function getCreatedTestsByUserId (int $id)
    {
       return User::find($id)->tests()->orderBy('created_at','desc')->get();
    }
}

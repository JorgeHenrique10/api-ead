<?php

namespace App\Repositories\Traits;

use App\Models\User;

trait RepositoryTrait
{
    public function getUserAuth(): User
    {
        return User::first();
    }
}

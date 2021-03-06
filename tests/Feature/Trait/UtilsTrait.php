<?php

namespace Tests\Feature\Trait;

use App\Models\User;

trait UtilsTrait
{
    public function getUser()
    {
        $user = User::factory()->create();
        return $user;
    }

    public function getHeader(User $user)
    {
        $token = $user->createToken('api')->plainTextToken;

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
    }
}

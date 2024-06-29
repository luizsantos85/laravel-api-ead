<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait UtilsTraitToken
{
    public function createUser()
    {
        $user = User::factory()->create();
        return $user;
    }

    public function createTokenUser()
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;
        return $token;
    }

    public function defaultHeaders()
    {
        return [
            "Authorization" => "Bearer {$this->createTokenUser()}"
        ];
    }


}


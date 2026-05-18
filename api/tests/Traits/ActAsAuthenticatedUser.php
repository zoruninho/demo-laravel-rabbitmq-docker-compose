<?php

namespace Tests\Traits;

use App\Models\User;

trait ActAsAuthenticatedUser
{
    protected User $authenticatedUser;

    protected string $token;

    protected function setUpActAsAuthenticatedUser(): void
    {
        $this->authenticatedUser = User::factory()->create();
        $this->token = $this->authenticatedUser->createToken('api-token')->plainTextToken;
    }
}

<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\CreateAccount;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_an_account(): void
    {
        $this->executeService();
    }

    private function executeService(): void
    {
        $user = (new CreateAccount(
            email: 'john@email.com',
            password: 'johnny',
        ))->execute();

        $this->assertInstanceOf(
            User::class,
            $user
        );

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'john@email.com',
        ]);
    }
}

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

        $this->assertDatabaseHas('lists', [
            'name' => 'Favoris',
            'is_public' => false,
            'can_be_modified' => false,
            'is_list_of_favorites' => true,
        ]);

        $this->assertDatabaseHas('lists', [
            'name' => 'Votre première liste',
            'is_public' => false,
            'can_be_modified' => true,
            'is_list_of_favorites' => false,
        ]);
    }
}

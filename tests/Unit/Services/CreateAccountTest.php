<?php

namespace Tests\Unit\Services;

use App\Jobs\PopulateAccount;
use App\Models\User;
use App\Services\CreateAccount;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
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
        Queue::fake();

        $user = (new CreateAccount(
            email: 'john@email.com',
            password: 'johnny',
            firstName: 'johnny',
            lastName: 'depp',
            organizationName: 'johnny inc',
        ))->execute();

        $this->assertInstanceOf(
            User::class,
            $user
        );

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'johnny',
            'last_name' => 'depp',
            'name_for_avatar' => 'johnny',
            'email' => 'john@email.com',
            'organization_id' => $user->organization_id,
            'permissions' => 'administrator',
        ]);

        $this->assertDatabaseHas('organizations', [
            'id' => $user->organization_id,
            'name' => 'johnny inc',
        ]);

        Queue::assertPushed(PopulateAccount::class);
    }
}

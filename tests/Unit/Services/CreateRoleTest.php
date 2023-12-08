<?php

namespace Tests\Unit\Services;

use App\Models\Role;
use App\Models\User;
use App\Services\CreateRole;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_role(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_ACCOUNT_MANAGER,
        ]);
        $this->executeService($user);
    }

    /** @test */
    public function it_fails_if_the_user_doesnt_have_the_right_permissions(): void
    {
        $this->expectException(Exception::class);
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);
        $this->executeService($user);
    }

    private function executeService(User $user): void
    {
        $this->actingAs($user);
        $role = (new CreateRole('developer'))->execute();

        $this->assertInstanceOf(
            Role::class,
            $role
        );

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'organization_id' => $user->organization_id,
            'label' => 'developer',
        ]);
    }
}

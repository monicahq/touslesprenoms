<?php

namespace Tests\Unit\Services;

use App\Models\Role;
use App\Models\User;
use App\Services\DestroyRole;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DestroyRoleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_destroys_a_role(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_ACCOUNT_MANAGER,
        ]);
        $role = Role::factory()->create([
            'organization_id' => $user->organization_id,
        ]);
        $this->executeService($role, $user);
    }

    /** @test */
    public function it_fails_if_the_user_doesnt_have_the_right_permissions(): void
    {
        $this->expectException(Exception::class);
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);
        $role = Role::factory()->create([
            'organization_id' => $user->organization_id,
        ]);
        $this->executeService($role, $user);
    }

    /** @test */
    public function it_fails_if_the_role_doesnt_belong_to_organization(): void
    {
        $this->expectException(Exception::class);
        $user = User::factory()->create([
            'permissions' => User::ROLE_ACCOUNT_MANAGER,
        ]);
        $role = Role::factory()->create();
        $this->executeService($role, $user);
    }

    private function executeService(Role $role, User $user): void
    {
        $this->actingAs($user);
        (new DestroyRole(
            role: $role,
        ))->execute();

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }
}

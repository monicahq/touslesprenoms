<?php

namespace Tests\Feature\Settings;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_lists_a_list_of_roles(): void
    {
        $role = Role::factory()->create([
            'label' => 'Developer',
        ]);
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
            'organization_id' => $role->organization_id,
        ]);
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
            'organization_id' => $role->organization_id,
        ]);

        $this->actingAs($user)
            ->get('/settings/roles')
            ->assertStatus(401);

        $this->actingAs($administrator)
            ->get('/settings/roles')
            ->assertStatus(200);

        $this->actingAs($administrator)
            ->get('/settings/roles')
            ->assertSee('Developer');
    }

    /** @test */
    public function an_administrator_can_create_a_new_role(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);

        $this->actingAs($user)
            ->post('/settings/roles', [
                'label' => fake()->name,
            ])
            ->assertStatus(401);

        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($administrator)
            ->post('/settings/roles', [
                'label' => 'Software engineer',
            ])
            ->assertRedirectToRoute('settings.role.index');

        $this->actingAs($administrator)
            ->get('/settings/roles')
            ->assertSee('Software engineer');
    }

    /** @test */
    public function a_role_can_be_edited(): void
    {
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);
        $role = Role::factory()->create([
            'organization_id' => $administrator->organization_id,
        ]);

        $this->actingAs($administrator)
            ->put('/settings/roles/' . $role->id, [
                'label' => 'Software engineer',
            ])
            ->assertStatus(302)
            ->assertRedirectToRoute('settings.role.index');
    }

    // /** @test */
    public function a_role_cant_be_edited_with_the_wrong_permission(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);
        $role = Role::factory()->create([
            'organization_id' => $user->organization_id,
        ]);

        $this->actingAs($user)
            ->put('/settings/roles/' . $role->id, [
                'label' => 'Software engineer',
            ])
            ->assertStatus(401);
    }
}

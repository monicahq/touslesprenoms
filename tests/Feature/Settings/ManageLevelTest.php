<?php

namespace Tests\Feature\Settings;

use App\Models\Level;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLevelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_lists_a_list_of_levels(): void
    {
        $level = Level::factory()->create([
            'label' => 'Intermediate',
        ]);
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
            'organization_id' => $level->organization_id,
        ]);
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
            'organization_id' => $level->organization_id,
        ]);

        $this->actingAs($user)
            ->get('/settings/levels')
            ->assertStatus(401);

        $this->actingAs($administrator)
            ->get('/settings/levels')
            ->assertStatus(200);

        $this->actingAs($administrator)
            ->get('/settings/levels')
            ->assertSee('Intermediate');
    }

    /** @test */
    public function an_administrator_can_create_a_new_level(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);

        $this->actingAs($user)
            ->post('/settings/levels', [
                'label' => fake()->name,
            ])
            ->assertStatus(401);

        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($administrator)
            ->post('/settings/levels', [
                'label' => 'Advanced',
            ])
            ->assertRedirectToRoute('settings.level.index');

        $this->actingAs($administrator)
            ->get('/settings/levels')
            ->assertSee('Advanced');
    }

    /** @test */
    public function a_level_can_be_edited(): void
    {
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);
        $level = Level::factory()->create([
            'organization_id' => $administrator->organization_id,
        ]);

        $this->actingAs($administrator)
            ->put('/settings/levels/' . $level->id, [
                'label' => 'Intermediate',
            ])
            ->assertStatus(302)
            ->assertRedirectToRoute('settings.level.index');
    }

    // /** @test */
    public function a_level_cant_be_edited_with_the_wrong_permission(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);
        $level = Level::factory()->create([
            'organization_id' => $user->organization_id,
        ]);

        $this->actingAs($user)
            ->put('/settings/levels/' . $level->id, [
                'label' => 'Intermediate',
            ])
            ->assertStatus(401);
    }
}

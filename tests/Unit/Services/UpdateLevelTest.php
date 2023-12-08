<?php

namespace Tests\Unit\Services;

use App\Models\Level;
use App\Models\User;
use App\Services\UpdateLevel;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateLevelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_updates_a_level(): void
    {
        $user = User::factory()->create([
            'permissions' => User::ROLE_ACCOUNT_MANAGER,
        ]);
        $level = Level::factory()->create([
            'organization_id' => $user->organization_id,
        ]);
        $this->executeService($level, $user);
    }

    /** @test */
    public function it_fails_if_the_user_doesnt_have_the_right_permissions(): void
    {
        $this->expectException(Exception::class);
        $user = User::factory()->create([
            'permissions' => User::ROLE_USER,
        ]);
        $level = Level::factory()->create([
            'organization_id' => $user->organization_id,
        ]);
        $this->executeService($level, $user);
    }

    /** @test */
    public function it_fails_if_the_level_doesnt_belong_to_organization(): void
    {
        $this->expectException(Exception::class);
        $user = User::factory()->create([
            'permissions' => User::ROLE_ACCOUNT_MANAGER,
        ]);
        $level = Level::factory()->create();
        $this->executeService($level, $user);
    }

    private function executeService(Level $level, User $user): void
    {
        $this->actingAs($user);
        $level = (new UpdateLevel(
            level: $level,
            label: 'developer'
        ))->execute();

        $this->assertInstanceOf(
            Level::class,
            $level
        );

        $this->assertDatabaseHas('levels', [
            'id' => $level->id,
            'organization_id' => $user->organization_id,
            'label' => 'developer',
        ]);
    }
}

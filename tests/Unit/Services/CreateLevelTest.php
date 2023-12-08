<?php

namespace Tests\Unit\Services;

use App\Models\Level;
use App\Models\User;
use App\Services\CreateLevel;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateLevelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_level(): void
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
        $level = (new CreateLevel('intermediate'))->execute();

        $this->assertInstanceOf(
            Level::class,
            $level
        );

        $this->assertDatabaseHas('levels', [
            'id' => $level->id,
            'organization_id' => $user->organization_id,
            'label' => 'intermediate',
        ]);
    }
}

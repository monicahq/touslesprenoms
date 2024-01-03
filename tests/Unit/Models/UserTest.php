<?php

namespace Tests\Unit\Models;

use App\Models\NameList;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_many_lists(): void
    {
        $user = User::factory()->create();
        $list = NameList::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($user->lists()->exists());
    }
}

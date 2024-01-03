<?php

namespace Tests\Unit\Models;

use App\Models\Name;
use App\Models\NameList;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NameListTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $list = NameList::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($list->user()->exists());
    }

    /** @test */
    public function it_has_many_names(): void
    {
        $list = NameList::factory()->create();
        $name = Name::factory()->create();
        $list->names()->attach($name);

        $this->assertTrue($list->names()->exists());
    }
}

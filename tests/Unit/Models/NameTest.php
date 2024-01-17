<?php

namespace Tests\Unit\Models;

use App\Models\Name;
use App\Models\NameList;
use App\Models\NameStatistic;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NameTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_many_statistics(): void
    {
        $name = Name::factory()->create();
        $nameStats = NameStatistic::factory()->create([
            'name_id' => $name->id,
        ]);

        $this->assertTrue($name->nameStatistics()->exists());
    }

    /** @test */
    public function it_has_many_name_lists(): void
    {
        $list = NameList::factory()->create();
        $name = Name::factory()->create();
        $name->lists()->attach($list);

        $this->assertTrue($name->lists()->exists());
    }

    /** @test */
    public function it_gets_the_content_of_the_note_for_the_user_if_it_is_set(): void
    {
        $name = Name::factory()->create();
        $user = User::factory()->create();
        $this->be($user);
        Note::factory()->create([
            'name_id' => $name->id,
            'user_id' => $user->id,
            'content' => 'This is a note',
        ]);

        $this->assertEquals(
            'This is a note',
            $name->getNoteForUser()
        );
    }
}

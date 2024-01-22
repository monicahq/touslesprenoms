<?php

namespace Tests\Unit\Models;

use App\Models\Name;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_belongs_to_a_name(): void
    {
        $name = Name::factory()->create();
        $note = Note::factory()->create([
            'name_id' => $name->id,
        ]);

        $this->assertTrue($note->name()->exists());
    }

    /** @test */
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($note->user()->exists());
    }
}

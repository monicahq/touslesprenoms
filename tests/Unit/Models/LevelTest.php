<?php

namespace Tests\Unit\Models;

use App\Models\Level;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LevelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_belongs_to_one_organization(): void
    {
        $level = Level::factory()->create();
        $this->assertTrue($level->organization()->exists());
    }
}

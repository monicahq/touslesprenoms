<?php

namespace Tests\Unit\Jobs;

use App\Jobs\IncrementPageViewForName;
use App\Jobs\RecordTopicView;
use App\Models\Channel;
use App\Models\Name;
use App\Models\Topic;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IncrementPageViewForNameTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_increments_the_page_view_for_a_name(): void
    {
        $name = Name::factory()->create();

        IncrementPageViewForName::dispatch($name->id);

        $this->assertDatabaseHas('names', [
            'id' => $name->id,
            'page_views' => 2,
        ]);
    }
}

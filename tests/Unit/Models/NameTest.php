<?php

namespace Tests\Unit\Models;

use App\Models\Name;
use App\Models\NameList;
use App\Models\NameStatistic;
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
}

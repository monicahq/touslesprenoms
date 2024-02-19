<?php

namespace Tests\Unit\Models;

use App\Models\ListCategory;
use App\Models\Name;
use App\Models\NameList;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListCategoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_many_list_names(): void
    {
        $listCategory = ListCategory::factory()->create();
        $nameList = NameList::factory()->create([
           'list_category_id' => $listCategory->id,
        ]);

        $this->assertTrue($listCategory->nameLists()->exists());
    }
}

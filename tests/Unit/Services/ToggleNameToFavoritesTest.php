<?php

namespace Tests\Unit\Services;

use App\Models\Name;
use App\Models\NameList;
use App\Models\User;
use App\Services\ToggleNameToFavorites;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ToggleNameToFavoritesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_toggles_a_favorite(): void
    {
        $user = User::factory()->create();
        $name = Name::factory()->create();
        $list = NameList::factory()->create([
            'user_id' => $user->id,
            'is_list_of_favorites' => true,
        ]);

        $this->actingAs($user);

        $boolean = (new ToggleNameToFavorites(
            nameId: $name->id,
        ))->execute();

        $this->assertDatabaseHas('list_name', [
            'list_id' => $list->id,
            'name_id' => $name->id,
        ]);

        $this->assertTrue($boolean);

        $boolean = (new ToggleNameToFavorites(
            nameId: $name->id,
        ))->execute();

        $this->assertDatabaseMissing('list_name', [
            'list_id' => $list->id,
            'name_id' => $name->id,
        ]);

        $this->assertFalse($boolean);
    }

    /** @test */
    public function it_fails_if_the_list_of_favorites_doesnt_exist(): void
    {
        $user = User::factory()->create();
        $name = Name::factory()->create();

        $this->expectException(ModelNotFoundException::class);
        (new ToggleNameToFavorites(
            nameId: $name->id,
        ))->execute();
    }
}

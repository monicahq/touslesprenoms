<?php

namespace Tests\Unit\ViewModels\Settings;

use App\Http\ViewModels\Settings\SettingsLevelViewModel;
use App\Models\Level;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SettingsLevelViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_data_needed_for_the_index_view(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $array = SettingsLevelViewModel::index();

        $this->assertCount(1, $array);
        $this->assertArrayHasKey('levels', $array);
    }

    /** @test */
    public function it_gets_the_level_object(): void
    {
        $level = Level::factory()->create([
            'label' => 'Dunder',
        ]);
        $array = SettingsLevelViewModel::level($level);

        $this->assertCount(2, $array);
        $this->assertEquals(
            [
                'id' => $level->id,
                'label' => 'Dunder',
            ],
            $array
        );
    }
}

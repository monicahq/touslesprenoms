<?php

namespace Tests\Unit\ViewModels\Settings;

use App\Http\ViewModels\Settings\SettingsRoleViewModel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SettingsRoleViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_data_needed_for_the_index_view(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $array = SettingsRoleViewModel::index();

        $this->assertCount(1, $array);
        $this->assertArrayHasKey('roles', $array);
    }

    /** @test */
    public function it_gets_the_role_object(): void
    {
        $role = Role::factory()->create([
            'label' => 'Dunder',
        ]);
        $array = SettingsRoleViewModel::role($role);

        $this->assertCount(2, $array);
        $this->assertEquals(
            [
                'id' => $role->id,
                'label' => 'Dunder',
            ],
            $array
        );
    }
}

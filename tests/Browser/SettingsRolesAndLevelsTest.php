<?php

namespace Tests\Browser;

use App\Models\Level;
use App\Models\Role;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SettingsRolesAndLevelsTest extends DuskTestCase
{
    /** @test */
    public function it_lets_you_crud_a_role(): void
    {
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->browse(function (Browser $browser) use ($administrator): void {
            // create a new role
            $browser->loginAs($administrator)
                ->visit('/dashboard')
                ->click('@nav-settings-link')
                ->click('@manage-role-link')
                ->waitFor('@add-role-cta')
                ->click('@add-role-cta')
                ->assertPathIs('/settings/roles/new')
                ->type('label', 'Software developer')
                ->waitFor('@submit-form-button')
                ->click('@submit-form-button')
                ->assertPathIs('/settings/roles')
                ->assertSee('Software developer');

            // edit a role
            $role = Role::orderBy('updated_at', 'desc')
                ->where('organization_id', $administrator->organization_id)
                ->first();

            $browser->visit('/settings/roles')
                ->waitFor('@edit-role-' . $role->id)
                ->click('@edit-role-' . $role->id)
                ->type('label', 'Awesome developer')
                ->waitFor('@submit-form-button')
                ->click('@submit-form-button')
                ->assertPathIs('/settings/roles')
                ->assertSee('Awesome developer');

            // delete a role
            $browser->visit('/settings/roles')
                ->waitFor('@delete-role-' . $role->id)
                ->click('@delete-role-' . $role->id)
                ->acceptDialog()
                ->pause(150)
                ->assertDontSee('Awesome developer');
        });
    }

    /** @test */
    public function it_lets_you_crud_a_level(): void
    {
        $administrator = User::factory()->create([
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->browse(function (Browser $browser) use ($administrator): void {
            // create a level
            $browser->loginAs($administrator)
                ->visit('/dashboard')
                ->click('@nav-settings-link')
                ->waitFor('@manage-level-link')
                ->click('@manage-level-link')
                ->waitFor('@add-level-cta')
                ->click('@add-level-cta')
                ->type('label', 'Intermediate')
                ->waitFor('@submit-form-button')
                ->click('@submit-form-button')
                ->assertPathIs('/settings/levels')
                ->pause(150)
                ->assertSee('Intermediate');

            // edit a level
            $level = Level::orderBy('updated_at', 'desc')
                ->where('organization_id', $administrator->organization_id)
                ->first();

            $browser->visit('/settings/levels')
                ->waitFor('@edit-level-' . $level->id)
                ->click('@edit-level-' . $level->id)
                ->type('label', 'Intermediate Senior')
                ->waitFor('@submit-form-button')
                ->click('@submit-form-button')
                ->assertPathIs('/settings/levels')
                ->assertSee('Intermediate Senior');

            // delete a level
            $browser->visit('/settings/levels')
                ->waitFor('@delete-level-' . $level->id)
                ->click('@delete-level-' . $level->id)
                ->acceptDialog()
                ->pause(150)
                ->assertDontSee('Intermediate Senior');
        });
    }
}

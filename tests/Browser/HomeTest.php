<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    /**
     * @test
     */
    public function homePage(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/')
                ->assertPathIs('/')
                ->assertTitle(config('app.name'))
                ->assertSee('Tous les prénoms');
        });
    }
}

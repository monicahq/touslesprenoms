<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LocaleTest extends DuskTestCase
{
    /** @test */
    public function it_toggles_the_language(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/login')
                ->click('@locale-switch-french')
                ->assertSee('Se connecter')
                ->click('@locale-switch-english')
                ->assertSee('Log in');
        });
    }
}

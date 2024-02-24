<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered as RegisteredEvent;
use Pirsch\Facades\Pirsch;

class Registered
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(RegisteredEvent $event)
    {
        Pirsch::track('Registered', [
            'UserId' => $event->user->id,
        ]);
    }
}

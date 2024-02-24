<?php

namespace App\Listeners;

use App\Models\User;
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
        if ($event->user instanceof User) {
            Pirsch::track('Registered', [
                'UserId' => $event->user->id,
            ]);
        }
    }
}

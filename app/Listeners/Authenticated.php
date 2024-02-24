<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated as AuthenticatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pirsch\Facades\Pirsch;

class Authenticated implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(AuthenticatedEvent $event): void
    {
        if ($event->user instanceof User) {
            Pirsch::track('Authenticated', [
                'UserId' => $event->user->id,
            ]);
        }
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(AuthenticatedEvent $event): bool
    {
        return $event->user instanceof User && ! $event->user->is_administrator;
    }
}

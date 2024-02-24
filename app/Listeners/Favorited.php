<?php

namespace App\Listeners;

use App\Events\Favorited as FavoritedEvent;
use Pirsch\Facades\Pirsch;

class Favorited
{
    /**
     * Handle the event.
     */
    public function handle(FavoritedEvent $event): void
    {
        Pirsch::track('Favorited', [
            'UserId' => $event->user->id,
            'Name' => $event->favorited->name,
            'Id' => $event->favorited->id,
        ]);
    }
}

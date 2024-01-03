<?php

namespace App\Http\ViewModels\User;

use Illuminate\Support\Collection;

class UserViewModel
{
    /**
     * Get the list of favorites for the given user.
     */
    public static function favorites(): Collection
    {
        // first we get the favorite list
        $list = auth()->user()->lists()->where('is_list_of_favorites', true)->firstOrFail();

        $names = $list->names()->orderBy('name')->get()->map(function ($name) {
            return $name->id;
        });

        return $names;
    }
}

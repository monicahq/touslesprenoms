<?php

namespace App\Http\ViewModels\User;

use App\Helpers\StringHelper;
use App\Models\Name;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class UserViewModel
{
    /**
     * Get the list of favorites for the given user.
     *
     * @return Collection
     */
    public static function favorites(): Collection
    {
        // first we get the favorite list
        $list = auth()->user()->lists()->where('is_list_of_favorites', true)->firstOrFail();

        $names = $list->names()->orderBy('name')->get()->pluck('id');

        return $names;
    }
}

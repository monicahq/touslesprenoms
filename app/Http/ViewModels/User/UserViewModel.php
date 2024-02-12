<?php

namespace App\Http\ViewModels\User;

use App\Helpers\StringHelper;
use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

class UserViewModel
{
    /**
     * Get the list of favorites for the given user.
     * This serves as a cache for the favorites, that we can use in the view.
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

    public static function index(): array
    {
        $list = auth()->user()->lists()->where('is_list_of_favorites', true)->firstOrFail();

        $names = $list->names()
            ->orderBy('name')->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'total' => Number::format($name->total),
                'note' => $name->getNoteForUser(),
                'url' => [
                    'show' => route('name.show', [
                        'id' => $name->id,
                        'name' => StringHelper::sanitizeNameForURL($name->name),
                    ]),
                    'favorite' => route('favorite.update', [
                        'id' => $name->id,
                    ]),
                ],
            ]);

        return [
            'names' => $names,
        ];
    }
}

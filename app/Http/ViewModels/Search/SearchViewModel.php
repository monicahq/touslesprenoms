<?php

namespace App\Http\ViewModels\Search;

use App\Helpers\StringHelper;
use App\Models\Name;

class SearchViewModel
{
    public static function names(?string $term = null, int $limit = 20): array
    {
        $names = Name::search($term)
            ->orderBy('total', 'desc')
            ->take($limit)
            ->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'url' => [
                    'show' => route('name.show', [
                        'id' => $name->id,
                        'name' => StringHelper::sanitizeNameForURL($name->name),
                    ]),
                    'favorite' => route('favorite.update', [
                        'id' => $name->id,
                    ]),
                ],
            ])
            ->filter(function ($name) {
                return strpos($name['name'], '_prenoms_rares') === false;
            });

        return [
            'names' => $names,
            'total' => $names->count(),
        ];
    }
}

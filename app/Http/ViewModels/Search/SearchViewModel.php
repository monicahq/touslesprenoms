<?php

namespace App\Http\ViewModels\Search;

use App\Helpers\StringHelper;
use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SearchViewModel
{
    public static function names(string $term = null): array
    {
        $names = Name::search($term)
            ->where('name', '!=', '_PRENOMS_RARES')
            ->orderBy('total', 'desc')
            ->take(20)
            ->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'avatar' => $name->avatar,
                'url' => route('name.show', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
            ]);

        return [
            'names' => $names,
            'total' => $names->count(),
        ];
    }
}

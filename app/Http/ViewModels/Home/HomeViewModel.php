<?php

namespace App\Http\ViewModels\Home;

use App\Helpers\StringHelper;
use App\Http\ViewModels\Names\NameViewModel;
use App\Models\Name;
use App\Models\NameList;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class HomeViewModel
{
    public static function twentyMostPopularNames(): array
    {
        $maleNames = Name::where('gender', 'male')
            ->where('name', '!=', '_PRENOMS_RARES')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get()
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $femaleNames = Name::where('gender', 'female')
            ->where('name', '!=', '_PRENOMS_RARES')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get()
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $mixtedNames = Name::where('unisex', 1)
            ->where('name', '!=', '_PRENOMS_RARES')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get()
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $randomIds = Name::select('id')
            ->where('name', '!=', '_PRENOMS_RARES')
            ->inRandomOrder()
            ->take(10)
            ->get();
        $randomNames = Name::whereIn('id', $randomIds)
            ->get()
            ->map(fn (Name $name) => NameViewModel::summary($name));

        return [
            'male_names' => $maleNames,
            'female_names' => $femaleNames,
            'mixted_names' => $mixtedNames,
            'random_names' => $randomNames,
        ];
    }

    public static function nameSpotlight(): array
    {
        $name = Cache::remember('name-of-the-day', 86400, function () {
            $id = Name::select('id')
                ->where('total', '>', 10000)
                ->inRandomOrder()
                ->first();

            return Name::whereIn('id', $id ?? [])
                ->select('id', 'name', 'origins')
                ->first();
        });

        return [
            'id' => optional($name)->id,
            'name' => StringHelper::formatNameFromDB(optional($name)->name),
            'origins' => Str::words(optional($name)->origins, 50, '...'),
            'url' => $name ? route('name.show', [
                'id' => $name->id,
                'name' => StringHelper::sanitizeNameForURL($name->name),
            ]) : '',
        ];
    }

    public static function serverStats(): array
    {
        $totalNames = Name::where('name', '!=', '_PRENOMS_RARES')->count();

        return [
            'total_names' => Number::format($totalNames),
        ];
    }

    /**
     * Get the list of all the public lists that administrators have set public.
     */
    public static function adminLists(): Collection
    {
        $ids = NameList::select('id')
            ->where('is_public', true)
            ->inRandomOrder()
            ->get();

        return NameList::whereIn('id', $ids)
            ->withCount('names')
            ->with('names')
            ->get()
            ->map(fn (NameList $list) => [
                'id' => $list->id,
                'name' => $list->name,
                'total' => Number::format($list->names_count, locale: 'fr'),
                'names' => $list->names()
                    ->inRandomOrder()
                    ->take(4)
                    ->get()
                    ->map(fn (Name $name) => [
                        'id' => $name->id,
                        'name' => StringHelper::formatNameFromDB($name->name),
                        'url' => [
                            'show' => route('name.show', [
                                'id' => $name->id,
                                'name' => StringHelper::sanitizeNameForURL($name->name),
                            ]),
                        ],
                    ]),
                'url' => [
                    'show' => route('list.public.show', [
                        'liste' => $list->id,
                    ]),
                ],
            ]);
    }
}

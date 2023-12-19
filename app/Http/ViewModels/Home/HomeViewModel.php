<?php

namespace App\Http\ViewModels\Home;

use App\Helpers\StringHelper;
use App\Models\Name;
use Illuminate\Support\Facades\Cache;
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
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'avatar' => $name->avatar,
                'url' => route('name.show', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
            ]);

        $femaleNames = Name::where('gender', 'female')
            ->where('name', '!=', '_PRENOMS_RARES')
            ->orderBy('total', 'desc')
            ->take(10)
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

        $randomNames = Name::where('name', '!=', '_PRENOMS_RARES')
            ->inRandomOrder()
            ->take(10)
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
            'male_names' => $maleNames,
            'female_names' => $femaleNames,
            'random_names' => $randomNames,
        ];
    }

    public static function nameSpotlight(): array
    {
        $name = Cache::remember('name-of-the-day', 86400, function () {
            return Name::where('total', '>', 5600)
                ->select('id', 'name', 'origins')
                ->inRandomOrder()
                ->first();
        });

        return [
            'id' => $name->id,
            'name' => StringHelper::formatNameFromDB($name->name),
            'avatar' => $name->avatar,
            'origins' => Str::words($name->origins, 50, '...'),
            'url' => route('name.show', [
                'id' => $name->id,
                'name' => StringHelper::sanitizeNameForURL($name->name),
            ]),
        ];
    }

    public static function serverStats(): array
    {
        $totalNames = Name::where('name', '!=', '_PRENOMS_RARES')->count();

        return [
            'total_names' => $totalNames,
        ];
    }
}

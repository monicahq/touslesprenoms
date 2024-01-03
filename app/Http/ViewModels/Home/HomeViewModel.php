<?php

namespace App\Http\ViewModels\Home;

use App\Helpers\StringHelper;
use App\Http\ViewModels\Names\NameViewModel;
use App\Models\Name;
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

        $randomNames = Name::where('name', '!=', '_PRENOMS_RARES')
            ->inRandomOrder()
            ->take(10)
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
            return Name::where('total', '>', 10000)
                ->select('id', 'name', 'origins')
                ->inRandomOrder()
                ->first();
        });

        return [
            'id' => $name->id,
            'name' => StringHelper::formatNameFromDB($name->name),
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
            'total_names' => Number::format($totalNames, locale: 'fr'),
        ];
    }
}

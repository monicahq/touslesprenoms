<?php

namespace App\Http\ViewModels\Names;

use App\Helpers\StringHelper;
use App\Models\Name;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class NameViewModel
{
    public static function details(Name $name): array
    {
        return [
            'id' => $name->id,
            'name' => StringHelper::getProperName($name->name),
            'avatar' => $name->avatar,
            'origins' => Str::of($name->origins)->markdown(),
            'personality' => Str::of($name->personality)->markdown(),
            'country_of_origin' => Str::of($name->country_of_origin)->markdown(),
            'celebrities' => Str::of($name->celebrities)->markdown(),
            'elfic_traits' => Str::of($name->elfic_traits)->markdown(),
            'name_day' => Str::of($name->name_day)->markdown(),
            'litterature_artistics_references' => Str::of($name->litterature_artistics_references)->markdown(),
            'similar_names_in_other_languages' => Str::of($name->similar_names_in_other_languages)->markdown(),
            'klingon_translation' => Str::of($name->klingon_translation)->markdown(),
            'total' => $name->total,
            'url' => route('name.show', [
                'id' => $name->id,
                'name' => StringHelper::sanitizeNameForURL($name->name),
            ]),
        ];
    }

    public static function jsonLdSchema(Name $name): array
    {
        return [
            'headline' => 'Tout savoir sur le prénom ' . StringHelper::getProperName($name->name),
            'image' => env('APP_URL') . '/images/facebook.png',
            'date' => Carbon::now()->format('Y-m-d'),
            'url' => route('name.show', [
                'id' => $name->id,
                'name' => StringHelper::sanitizeNameForURL($name->name),
            ]),
        ];
    }

    public static function relatedNames(Name $name): Collection
    {
        return Name::where('name', '!=', '_PRENOMS_RARES')
            ->where('id', '!=', $name->id)
            ->where('gender', $name->gender)
            ->inRandomOrder()
            ->take(10)
            ->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::getProperName($name->name),
                'avatar' => $name->avatar,
                'url' => route('name.show', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
            ]);
    }
}

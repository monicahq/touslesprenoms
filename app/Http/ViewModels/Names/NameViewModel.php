<?php

namespace App\Http\ViewModels\Names;

use App\Helpers\StringHelper;
use App\Models\Name;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class NameViewModel
{
    public static function summary(mixed $name): array
    {
        return [
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
        ];
    }

    public static function details(Name $name): array
    {
        Carbon::setLocale('fr');

        return [
            'id' => $name->id,
            'name' => StringHelper::formatNameFromDB($name->name),
            'origins' => Str::of($name->origins)->markdown(),
            'personality' => Str::of($name->personality)->markdown(),
            'syllabes' => $name->syllabes,
            'celebrities' => Str::of($name->celebrities)->markdown(),
            'elfic_traits' => Str::of($name->elfic_traits)->markdown(),
            'name_day' => Str::of($name->name_day)->markdown(),
            'litterature_artistics_references' => Str::of($name->litterature_artistics_references)->markdown(),
            'similar_names_in_other_languages' => Str::of($name->similar_names_in_other_languages)->markdown(),
            'klingon_translation' => null,
            'total' => $name->total,
            'gender' => $name->gender === 'male' ? 'Masculin' : 'Féminin',
            'mixte' => $name->unisex ? 'Oui' : 'Non',
            'updated_at' => $name->updated_at->isoFormat('LL'),
            'url' => [
                'show' => route('name.show', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
                'favorite' => route('favorite.name.update', [
                    'id' => $name->id,
                ]),
                'note_edit' => route('user.name.update', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
            ],
        ];
    }

    public static function popularity(Name $name): array
    {
        $decades = range(1900, Carbon::now()->year, 10);

        $decadesCollection = collect();
        foreach ($decades as $decade) {
            $popularity = $name->nameStatistics()
                ->where('year', '>=', $decade)
                ->where('year', '<', $decade + 9)
                ->sum('count');

            $decadesCollection->push([
                'decade' => $decade . 's',
                'popularity' => $popularity,
                'percentage' => 0,
            ]);
        }

        // now we need to add the percentage of popularity for each decade
        $total = $decadesCollection->sum('popularity');
        $decadesCollection = $decadesCollection->map(function ($decade) use ($total) {
            if ($total > 0) {
                $decade['percentage'] = Number::format(round($decade['popularity'] / $total * 100), locale: 'fr');
            } else {
                $decade['percentage'] = 0;
            }

            return $decade;
        });

        // calculate the total popularity
        $total = $name->total;

        return [
            'decades' => $decadesCollection,
            'total' => Number::format($total, locale: 'fr'),
        ];
    }

    public static function jsonLdSchema(Name $name): array
    {
        return [
            'headline' => 'Tout savoir sur le prénom ' . StringHelper::formatNameFromDB($name->name),
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
            ->map(fn (Name $name) => NameViewModel::summary($name));
    }

    public static function numerology(Name $name): int
    {
        // for each letter in the name, we need to get the corresponding number
        // letter A is 1, letter B is 2, etc... until letter I is 9
        // then we start over, letter J is 1, letter K is 2, etc... until letter R is 9
        // then we start over, letter S is 1, letter T is 2, etc... until letter Z is 8
        // then we add all the numbers together and we get the number for the name
        // if the number is greater than 9, we add the digits together until we get a number between 1 and 9
        // if the number is 11, 22 or 33, we keep it as is

        $letters = str_split($name->name);
        $numbers = [];
        foreach ($letters as $letter) {
            if ($letter === '_' || $letter === ' ' || $letter === '-' || $letter === "'") {
                continue;
            }

            $number = match ($letter) {
                'A', 'J', 'S' => 1,
                'B', 'K', 'T' => 2,
                'C', 'L', 'U' => 3,
                'D', 'M', 'V' => 4,
                'E', 'N', 'W' => 5,
                'F', 'O', 'X' => 6,
                'G', 'P', 'Y' => 7,
                'H', 'Q', 'Z' => 8,
                'I', 'R' => 9,
                default => 0,
            };

            $numbers[] = $number;
        }

        $number = array_sum($numbers);
        while ($number > 9) {
            $number = array_sum(str_split($number));
        }

        return $number;
    }
}

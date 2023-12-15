<?php

namespace App\Http\ViewModels\Names;

use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class AllNamesViewModel
{
    public static function index(): Collection
    {
        // iterate over the alphabet
        $alphabet = range('A', 'Z');

        $letters = collect();

        $letters->push([
            'letter' => 'Tous',
            'count' => Number::format(Name::where('name', '!=', '_PRENOMS_RARES')->count(), locale: 'fr'),
            'url' => route('name.index'),
        ]);

        foreach ($alphabet as $letter) {
            $letters->push([
                'letter' => $letter,
                'count' => Number::format(Name::where('name', 'like', $letter . '%')->count(), locale: 'fr'),
                'url' => route('name.letter', ['letter' => Str::lcfirst($letter)]),
            ]);
        }

        return $letters;
    }
}

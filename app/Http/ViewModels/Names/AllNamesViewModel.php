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
        $letters = collect();
        $allNames = Name::where('name', '!=', '_PRENOMS_RARES')->count();
        $letters->push([
            'letter' => 'Tous',
            'count' => Number::format($allNames),
            'url' => route('name.index'),
        ]);

        $alphabet = range('A', 'Z');
        foreach ($alphabet as $letter) {
            $count = Name::where('name', 'like', $letter . '%')->count();

            $letters->push([
                'letter' => $letter,
                'count' => Number::format($count),
                'url' => route('name.letter', ['letter' => Str::lower($letter)]),
            ]);
        }

        return $letters;
    }
}

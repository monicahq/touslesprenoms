<?php

namespace App\Http\ViewModels\Names;

use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class FemaleNamesViewModel
{
    public static function index(): Collection
    {
        // iterate over the alphabet
        $alphabet = range('A', 'Z');

        $total = Name::where('gender', 'female')
            ->where('name', '!=', '_PRENOMS_RARES')->count();

        $letters = collect();
        $letters->push([
            'letter' => 'Tous',
            'count' => Number::format($total),
            'url' => route('name.fille.index'),
        ]);

        foreach ($alphabet as $letter) {
            $total = Name::where('gender', 'female')
                ->where('name', 'like', $letter . '%')->count();
            $letters->push([
                'letter' => $letter,
                'count' => Number::format($total),
                'url' => route('name.fille.letter', [
                    'letter' => Str::lcfirst($letter),
                ]),
            ]);
        }

        return $letters;
    }
}

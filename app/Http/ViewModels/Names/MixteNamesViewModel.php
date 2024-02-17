<?php

namespace App\Http\ViewModels\Names;

use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class MixteNamesViewModel
{
    public static function index(): Collection
    {
        // iterate over the alphabet
        $alphabet = range('A', 'Z');

        $total = Name::where('unisex', 1)
            ->where('name', '!=', '_PRENOMS_RARES')->count();

        $letters = collect();
        $letters->push([
            'letter' => 'Tous',
            'count' => Number::format($total),
            'url' => route('name.mixte.index'),
        ]);

        foreach ($alphabet as $letter) {
            $total = Name::where('unisex', 1)
                ->where('name', 'like', $letter . '%')->count();
            $letters->push([
                'letter' => $letter,
                'count' => Number::format($total),
                'url' => route('name.mixte.letter', [
                    'letter' => Str::lcfirst($letter),
                ]),
            ]);
        }

        return $letters;
    }
}

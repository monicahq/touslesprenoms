<?php

namespace App\Http\ViewModels\Names;

use App\Models\Name;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class MaleNamesViewModel
{
    public static function index(): Collection
    {
        // iterate over the alphabet
        $alphabet = range('A', 'Z');

        $total = Name::where('gender', 'male')
            ->where('name', '!=', '_PRENOMS_RARES')->count();

        $letters = collect();
        $letters->push([
            'letter' => 'Tous',
            'count' => Number::format($total),
            'url' => route('name.garcon.index'),
        ]);

        foreach ($alphabet as $letter) {
            $total = Name::where('gender', 'male')
                ->where('name', 'like', $letter . '%')->count();
            $letters->push([
                'letter' => $letter,
                'count' => Number::format($total),
                'url' => route('name.garcon.letter', [
                    'letter' => Str::lcfirst($letter),
                ]),
            ]);
        }

        return $letters;
    }
}

<?php

namespace App\Http\ViewModels;

use App\Helpers\StringHelper;
use App\Models\Level;
use App\Models\Name;
use Illuminate\Support\Str;

class NameViewModel
{
    /**
     * Get information the given name, necessary for the name page.
     *
     * @return array
     */
    public static function get(): array
    {
        $maleNames = Name::where('gender', 'male')
            ->orderBy('total', 'desc')
            ->take(20)
            ->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => $name->name,
                'avatar' => $name->avatar,
                'url' => route('name.show', $name),
            ]);

        $femaleNames = Name::where('gender', 'female')
            ->orderBy('total', 'desc')
            ->take(20)
            ->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => $name->name,
                'avatar' => $name->avatar,
                'url' => route('name.show', $name),
            ]);

        return [
            'male_names' => $maleNames,
            'female_names' => $femaleNames,
        ];
    }
}

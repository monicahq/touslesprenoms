<?php

namespace App\Http\ViewModels\User;

use App\Helpers\StringHelper;
use App\Models\Name;
use App\Models\NameList;
use Illuminate\Support\Number;

class PublicListViewModel
{
    public static function show(NameList $list): array
    {
        $names = $list->names()
            ->withPivot('public_note')
            ->orderBy('name')->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'total' => Number::format($name->total),
                'public_note' => $name->pivot->public_note,
                'url' => [
                    'show' => route('name.show', [
                        'id' => $name->id,
                        'name' => StringHelper::sanitizeNameForURL($name->name),
                    ]),
                    'favorite' => route('favorite.update', [
                        'id' => $name->id,
                    ]),
                ],
            ]);

        return [
            'id' => $list->id,
            'name' => $list->name,
            'description' => $list->description,
            'names' => $names,
            'created_at' => $list->created_at->isoFormat('LL'),
            'url' => [
                'show' => route('list.show', [
                    'liste' => $list->id,
                ]),
            ],
        ];
    }
}

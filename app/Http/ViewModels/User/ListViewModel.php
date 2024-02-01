<?php

namespace App\Http\ViewModels\User;

use App\Helpers\StringHelper;
use App\Models\Name;
use App\Models\NameList;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class ListViewModel
{
    /**
     * Get all the lists, except the favorites, of the logged user.
     */
    public static function index(): array
    {
        $lists = auth()->user()
            ->lists()
            ->where('is_list_of_favorites', false)
            ->withCount('names')
            ->get()
            ->map(fn (NameList $list) => [
                'id' => $list->id,
                'name' => $list->name,
                'total' => Number::format($list->names_count, locale: 'fr'),
                'url' => [
                    'show' => route('list.show', [
                        'liste' => $list->id,
                    ]),
                ],
            ]);

        return [
            'lists' => $lists,
        ];
    }

    public static function show(NameList $list): array
    {
        $names = $list->names()
            ->orderBy('name')->get()
            ->map(fn (Name $name) => [
                'id' => $name->id,
                'name' => StringHelper::formatNameFromDB($name->name),
                'origins' => Str::words($name->origins, 50, '...'),
                'total' => Number::format($name->total, locale: 'fr'),
                'url' => [
                    'show' => route('name.show', [
                        'id' => $name->id,
                        'name' => StringHelper::sanitizeNameForURL($name->name),
                    ]),
                    'destroy' => route('list.name.destroy', [
                        'liste' => $list->id,
                        'id' => $name->id,
                    ]),
                ],
            ]);

        return [
            'id' => $list->id,
            'name' => $list->name,
            'description' => $list->description,
            'names' => $names,
            'uuid' => StringHelper::shareLink($list->uuid),
            'visibility' => $list->is_public,
            'url' => [
                'show' => route('list.show', [
                    'liste' => $list->id,
                ]),
                'edit' => route('list.edit', [
                    'liste' => $list->id,
                ]),
                'delete' => route('list.delete', [
                    'liste' => $list->id,
                ]),
                'search' => route('list.search.index', [
                    'liste' => $list->id,
                ]),
                'visibility' => route('list.system.update', [
                    'liste' => $list->id,
                ]),
            ],
        ];
    }

    public static function edit(NameList $list): array
    {
        return [
            'id' => $list->id,
            'name' => $list->name,
            'description' => $list->description,
            'url' => [
                'update' => route('list.update', [
                    'liste' => $list->id,
                ]),
            ],
        ];
    }

    public static function delete(NameList $list): array
    {
        return [
            'id' => $list->id,
            'name' => $list->name,
            'url' => [
                'destroy' => route('list.destroy', [
                    'liste' => $list->id,
                ]),
            ],
        ];
    }

    /**
     * The list of all the lists of the logged user.
     * It also indicates whether the given name already belongs to a list.
     */
    public static function lists(Name $name): array
    {
        $lists = auth()->user()
            ->lists()
            ->where('is_list_of_favorites', false)
            ->get();

        $listsCollection = collect();
        foreach ($lists as $list) {
            $listsCollection->push(self::getListDetail($list, $name));
        }

        return [
            'lists' => $listsCollection,
        ];
    }

    public static function getListDetail(NameList $list, Name $name): array
    {
        $containsName = $list->names()->where('name_id', $name->id)->exists();

        return [
            'id' => $list->id,
            'name' => $list->name,
            'contains_name' => $containsName,
            'url' => [
                'show' => route('list.show', [
                    'liste' => $list->id,
                ]),
                'store' => route('name.list.store', [
                    'liste' => $list->id,
                    'id' => $name->id,
                ]),
            ],
        ];
    }
}

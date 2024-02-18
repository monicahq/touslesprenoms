<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Services\AddNoteToName;
use App\Services\DestroyNote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserNameController extends Controller
{
    public function show(Request $request): View
    {
        $name = $request->attributes->get('name');

        return view('components.note-show', [
            'note' => $name->getNoteForUser(),
            'url' => route('user.name.edit', [
                'id' => $name->id,
            ]),
            'deleteUrl' => route('user.name.destroy', [
                'id' => $name->id,
            ]),
        ]);
    }

    public function edit(Request $request): View
    {
        $name = $request->attributes->get('name');

        return view('names.partials.edit-note', [
            'note' => $name->getNoteForUser(),
            'url' => [
                'show' => route('user.name.show', [
                    'id' => $name->id,
                ]),
                'update' => route('user.name.update', [
                    'id' => $name->id,
                    'name' => StringHelper::sanitizeNameForURL($name->name),
                ]),
            ],
        ]);
    }

    public function update(Request $request): View
    {
        $name = $request->attributes->get('name');

        (new AddNoteToName(
            nameId: $name->id,
            userId: auth()->id(),
            noteText: $request->input('note'),
        ))->execute();

        Cache::forget('user-favorites-' . auth()->id());
        Cache::forget('user-favorites-details-' . auth()->id());

        return view('components.note-show', [
            'note' => $name->getNoteForUser(),
            'url' => route('user.name.edit', [
                'id' => $name->id,
            ]),
            'deleteUrl' => route('user.name.destroy', [
                'id' => $name->id,
            ]),
        ]);
    }

    public function destroy(Request $request): View
    {
        $name = $request->attributes->get('name');

        (new DestroyNote(
            userId: auth()->id(),
            nameId: $name->id,
        ))->execute();

        Cache::forget('user-favorites-' . auth()->id());
        Cache::forget('user-favorites-details-' . auth()->id());

        return view('components.note-show', [
            'note' => $name->getNoteForUser(),
            'url' => route('user.name.edit', [
                'id' => $name->id,
            ]),
            'deleteUrl' => route('user.name.destroy', [
                'id' => $name->id,
            ]),
        ]);
    }
}

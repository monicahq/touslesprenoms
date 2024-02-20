<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\ToggleNameToNameList;
use App\Services\UpdateNoteToNameInList;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StoreNoteForNameInListController extends Controller
{
    public function edit(Request $request, int $listId, int $nameId): View
    {
        $requestedList = $request->attributes->get('list');

        $name = Name::findOrFail($nameId);

        $record = DB::table('list_name')
            ->where('name_id', $nameId)
            ->where('list_id', $listId)
            ->first();

        return view('user.lists.edit-note', [
            'list' => [
                'name' => $requestedList->name,
                'url' => [
                    'show' => route('list.show', ['liste' => $listId]),
                    'update' => route('name.list.update', [
                        'liste' => $listId,
                        'id' => $nameId,
                    ]),
                ],
            ],
            'name' => $name->name,
            'note' => is_null($record->public_note) ? '' : $record->public_note,
        ]);
    }

    /**
     * Add a note for the given name in the given list.
     */
    public function update(Request $request, int $listId, int $nameId): RedirectResponse
    {
        $requestedList = $request->attributes->get('list');

        (new UpdateNoteToNameInList(
            nameListId: $listId,
            nameId: $nameId,
            note: $request->input('note'),
        ))->execute();

        Cache::forget('route-list-' . $requestedList->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $requestedList->id);
        Cache::forget('admin-lists');

        return Redirect::route('list.show', [
            'liste' => $listId,
        ]);
    }

    public function destroy(Request $request, int $listId, int $nameId): void
    {
        $requestedList = $request->attributes->get('list');

        (new ToggleNameToNameList(
            nameId: $nameId,
            listId: $requestedList->id,
        ))->execute();

        Cache::forget('route-list-' . $requestedList->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $requestedList->id);
    }
}

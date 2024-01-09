<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\User\ListViewModel;
use App\Services\ToggleNameToNameList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class ListNameController extends Controller
{
    public function index(Request $request)
    {
        $requestedList = $request->attributes->get('list');

        $details = Cache::remember('list-details-' . $requestedList->id, 604800, function () use ($requestedList) {
            return ListViewModel::show($requestedList);
        });

        return view('user.lists.show', [
            'list' => $details,
        ]);
    }

    /**
     * Add or remove a name from the list
     */
    public function store(Request $request, int $listId, int $nameId): Response
    {
        $requestedList = $request->attributes->get('list');

        (new ToggleNameToNameList(
            nameId: $nameId,
            listId: $requestedList->id,
        ))->execute();

        Cache::forget('route-list-' . $requestedList->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $requestedList->id);

        return new HtmxResponseClientRedirect(route('list.show', [
            'liste' => $requestedList->id,
        ]));
    }

    public function destroy(Request $request, int $listId, int $nameId)
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

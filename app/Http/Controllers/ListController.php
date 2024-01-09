<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\User\ListViewModel;
use App\Services\CreateList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ListController extends Controller
{
    public function index(): View
    {
        $lists = Cache::remember('user-lists-' . auth()->id(), 604800, function () {
            return ListViewModel::index();
        });

        return view('user.lists.index', [
            'lists' => $lists['lists'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $list = (new CreateList(
            name: $request->input('list-name'),
            description: $request->input('description'),
            isPublic: false,
            canBeModified: true,
        ))->execute();

        Cache::forget('route-list-' . $list->id);
        Cache::forget('user-lists-' . auth()->id());

        return Redirect::route('list.show', [
            'liste' => $list->id,
        ]);
    }

    public function show(Request $request): View
    {
        $requestedList = $request->attributes->get('list');

        $details = Cache::remember('list-details-' . $requestedList->id, 604800, function () use ($requestedList) {
            return ListViewModel::show($requestedList);
        });

        return view('user.lists.show', [
            'term' => null,
            'list' => $details,
            'search_items' => null,
        ]);
    }

    public function edit(Request $request): View
    {
        return view('user.lists.edit', [
            'list' => ListViewModel::edit($request->attributes->get('list')),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $list = $request->attributes->get('list');

        $list->name = $request->input('list-name');
        $list->description = $request->input('description');
        $list->save();

        Cache::forget('route-list-' . $list->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $list->id);

        return Redirect::route('list.show', [
            'liste' => $list->id,
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $list = $request->attributes->get('list');

        $list->delete();

        Cache::forget('route-list-' . $list->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $list->id);

        return Redirect::route('list.index');
    }

    public function new(): View
    {
        return view('user.lists.new');
    }

    public function delete(Request $request): View
    {
        return view('user.lists.destroy', [
            'list' => ListViewModel::delete($request->attributes->get('list')),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class ListSystemController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $list = $request->attributes->get('list');

        if (! auth()->user()->is_administrator) {
            abort(403);
        }

        $list->is_public = ! $list->is_public;
        $list->save();

        Cache::forget('route-list-' . $list->id);
        Cache::forget('user-lists-' . auth()->id());
        Cache::forget('list-details-' . $list->id);
        Cache::forget('admin-lists');

        return Redirect::route('list.show', [
            'liste' => $list->id,
        ]);
    }
}

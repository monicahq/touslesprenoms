<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Search\SearchViewModel;
use App\Http\ViewModels\User\ListViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ListSearchController extends Controller
{
    public function index(Request $request): View
    {
        $requestedList = $request->attributes->get('list');

        $details = Cache::remember('list-details-' . $requestedList->id, 604800, fn () => ListViewModel::show($requestedList));

        $names = SearchViewModel::names($request->input('term'));

        return view('user.lists.partials.search-items', [
            'term' => $request->input('term'),
            'list' => $details,
            'search_items' => $names,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Search\SearchViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function index(): View
    {
        $stats = Cache::remember('stats', 604800, fn () => HomeViewModel::serverStats());

        return view('search.index', [
            'stats' => $stats,
            'names' => [],
            'term' => '',
            'favorites' => collect(),
        ]);
    }

    public function post(SearchRequest $request): View|string
    {
        $term = $request->input('term');

        $stats = Cache::remember('stats', 604800, fn () => HomeViewModel::serverStats());

        $names = Cache::remember('search-name-' . $term, 604800, fn () => SearchViewModel::names($term, 1000));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        $data = [
            'stats' => $stats,
            'names' => $names,
            'term' => $term,
            'favorites' => $favoritedNamesForLoggedUser,
        ];

        return $request->isHtmxRequest()
            ? view()->renderFragment('search.index', 'content', $data)
            : view('search.index', $data);
    }
}

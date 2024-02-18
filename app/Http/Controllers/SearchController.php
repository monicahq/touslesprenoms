<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Search\SearchViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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

    public function post(Request $request): View
    {
        $stats = Cache::remember('stats', 604800, fn () => HomeViewModel::serverStats());

        $term = trim($request->input('term'));

        $names = Cache::remember('search-name-' . $term, 604800, fn () => SearchViewModel::names($term, 1000));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('search.index', [
            'stats' => $stats,
            'names' => $names,
            'term' => $term,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

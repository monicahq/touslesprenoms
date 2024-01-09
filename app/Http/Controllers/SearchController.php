<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Search\SearchViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        $stats = Cache::remember('stats', 604800, function () {
            return HomeViewModel::serverStats();
        });

        return view('search.index', [
            'stats' => $stats,
            'names' => [],
            'term' => '',
            'favorites' => collect(),
        ]);
    }

    public function post(Request $request): View
    {
        $stats = Cache::remember('stats', 604800, function () {
            return HomeViewModel::serverStats();
        });

        $term = trim($request->input('term'));

        $names = Cache::remember('search-name-' . $term, 604800, function () use ($term) {
            return SearchViewModel::names($term, 1000);
        });

        if (!auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-' . auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });
        }

        return view('search.index', [
            'stats' => $stats,
            'names' => $names,
            'term' => $term,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

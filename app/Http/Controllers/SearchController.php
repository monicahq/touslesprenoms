<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Search\SearchViewModel;
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
            'names' => SearchViewModel::names(),
        ]);
    }

    public function post(Request $request): View
    {
        $stats = Cache::remember('stats', 604800, function () {
            return HomeViewModel::serverStats();
        });

        $term = trim($request->input('term'));
        $names = SearchViewModel::names($term);

        return view('search.index', [
            'stats' => $stats,
            'names' => $names,
            'term' => $term,
        ]);
    }
}

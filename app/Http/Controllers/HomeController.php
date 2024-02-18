<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(): View
    {
        $popularNames = Cache::remember('popular-names', 86400, fn () => HomeViewModel::twentyMostPopularNames());

        $stats = Cache::remember('stats', 604800, fn () => HomeViewModel::serverStats());

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        $lists = Cache::remember('admin-lists', 604800, fn () => HomeViewModel::adminLists());

        return view('home.index', [
            'twentyMostPopularNames' => $popularNames,
            'stats' => $stats,
            'nameSpotlight' => HomeViewModel::nameSpotlight(),
            'favorites' => $favoritedNamesForLoggedUser,
            'lists' => $lists,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $popularNames = Cache::remember('popular-names', 86400, function () {
            return HomeViewModel::twentyMostPopularNames();
        });

        $stats = Cache::remember('stats', 604800, function () {
            return HomeViewModel::serverStats();
        });

        if (!auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-'.auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });
        }

        return view('home.index', [
            'twentyMostPopularNames' => $popularNames,
            'stats' => $stats,
            'nameSpotlight' => HomeViewModel::nameSpotlight(),
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

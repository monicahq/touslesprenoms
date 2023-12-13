<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Team\TeamViewModel;
use App\Models\Team;
use App\Services\CreateTeam;
use App\Services\DestroyTeam;
use App\Services\UpdateTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class HomeController extends Controller
{
    public function index(): View
    {
        $popularNames = Cache::remember('popular-names', 604800, function () {
            return HomeViewModel::twentyMostPopularNames();
        });

        $stats = Cache::remember('stats', 604800, function () {
            return HomeViewModel::serverStats();
        });

        return view('home.index', [
            'twentyMostPopularNames' => $popularNames,
            'stats' => $stats,
            'nameSpotlight' => HomeViewModel::nameSpotlight(),
        ]);
    }
}

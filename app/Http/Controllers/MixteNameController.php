<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\MixteNamesViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MixteNameController extends Controller
{
    public function index(Request $request): View
    {
        // get the page parameter from the url
        $requestedPage = $request->query('page') ?? 1;

        $letters = Cache::remember('all-letters-mixte', 604800, function () {
            return MixteNamesViewModel::index();
        });

        Paginator::currentPageResolver(function () use ($requestedPage) {
            return $requestedPage;
        });

        $namesPagination = Cache::remember('all-names-mixte-page-' . $requestedPage, 604800, function () {
            return Name::where('name', '!=', '_PRENOMS_RARES')
                ->where('unisex', 1)
                ->orderBy('total', 'desc')
                ->paginate(40);
        });

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        if (! auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-' . auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });
        }

        return view('names.mixte.index', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }

    public function letter(Request $request): View
    {
        $requestedLetter = $request->attributes->get('letter');
        $requestedPage = $request->query('page') ?? 1;

        $letters = Cache::remember('all-letters-mixte', 604800, function () {
            return MixteNamesViewModel::index();
        });

        Paginator::currentPageResolver(function () use ($requestedPage) {
            return $requestedPage;
        });

        $namesPagination = Cache::remember('mixte-letter-' . $requestedLetter . '-page-' . $requestedPage, 604800, function () use ($requestedLetter) {
            return Name::where('name', '!=', '_PRENOMS_RARES')
                ->where('unisex', 1)
                ->where('name', 'like', $requestedLetter . '%')
                ->orderBy('total', 'desc')
                ->paginate(40);
        });

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        if (! auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-' . auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });
        }

        return view('names.mixte.letter', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'activeLetter' => Str::ucfirst($requestedLetter),
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

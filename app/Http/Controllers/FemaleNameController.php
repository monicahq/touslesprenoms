<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\FemaleNamesViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FemaleNameController extends Controller
{
    public function index(Request $request): View
    {
        // get the page parameter from the url
        $requestedPage = Paginator::resolveCurrentPage();

        $letters = Cache::remember('all-letters-female', 604800, fn () => FemaleNamesViewModel::index());

        $namesPagination = Cache::remember('all-names-female-page-' . $requestedPage, 604800, fn () => Name::nonRares()
            ->female()
            ->orderBy('total', 'desc')
            ->paginate(40)
        );

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('names.female.index', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }

    public function letter(Request $request): View
    {
        $requestedLetter = $request->attributes->get('letter');
        $requestedPage = Paginator::resolveCurrentPage();

        $letters = Cache::remember('all-letters-female', 604800, fn () => FemaleNamesViewModel::index());

        $namesPagination = Cache::remember('female-letter-' . $requestedLetter . '-page-' . $requestedPage, 604800, fn () => Name::nonRares()
            ->female()
            ->where('name', 'like', Str::upper($requestedLetter) . '%')
            ->orderBy('total', 'desc')
            ->paginate(40)
        );

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('names.female.letter', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'activeLetter' => Str::upper($requestedLetter),
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

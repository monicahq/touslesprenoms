<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\MaleNamesViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MaleNameController extends Controller
{
    public function index(Request $request): View
    {
        // get the page parameter from the url
        $requestedPage = $request->query('page') ?? 1;

        $letters = Cache::remember('all-letters-male', 604800, fn () => MaleNamesViewModel::index());

        Paginator::currentPageResolver(fn () => $requestedPage);

        $namesPagination = Cache::remember('all-names-male-page-' . $requestedPage, 604800, fn () =>
            Name::where('name', '!=', '_PRENOMS_RARES')
                ->where('gender', 'male')
                ->orderBy('total', 'desc')
                ->paginate(40)
        );

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('names.male.index', [
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

        $letters = Cache::remember('all-letters-male', 604800, fn () => MaleNamesViewModel::index());

        Paginator::currentPageResolver(fn () => $requestedPage);

        $namesPagination = Cache::remember('male-letter-' . $requestedLetter . '-page-' . $requestedPage, 604800, fn () =>
            Name::where('name', '!=', '_PRENOMS_RARES')
                ->where('gender', 'male')
                ->where('name', 'like', $requestedLetter . '%')
                ->orderBy('total', 'desc')
                ->paginate(40)
        );

        $names = $namesPagination
            ->map(fn (Name $name) => NameViewModel::summary($name));

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('names.male.letter', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'activeLetter' => Str::ucfirst($requestedLetter),
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\AllNamesViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\ListViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use App\Services\ToggleNameToNameList;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NameController extends Controller
{
    public function index(Request $request): View
    {
        // get the page parameter from the url
        $requestedPage = $request->query('page') ?? 1;

        $letters = Cache::remember('all-letters', 604800, function () {
            return AllNamesViewModel::index();
        });

        Paginator::currentPageResolver(function () use ($requestedPage) {
            return $requestedPage;
        });

        $namesPagination = Cache::remember('all-names-page-' . $requestedPage, 604800, function () {
            return Name::where('name', '!=', '_PRENOMS_RARES')
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

        return view('names.index', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }

    public function show(Request $request): View
    {
        $requestedName = $request->attributes->get('name');

        $name = Cache::remember('name-' . $requestedName->name, 604800, function () use ($requestedName) {
            return NameViewModel::details($requestedName);
        });

        $relatedNames = Cache::remember('related-names-' . $requestedName->name, 60, function () use ($requestedName) {
            return NameViewModel::relatedNames($requestedName);
        });

        $popularity = Cache::remember('popularity-' . $requestedName->name, 604800, function () use ($requestedName) {
            return NameViewModel::popularity($requestedName);
        });

        $numerology = Cache::remember('numerology-' . $requestedName->name, 604800, function () use ($requestedName) {
            return NameViewModel::numerology($requestedName);
        });

        if (! auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
            $lists = [];
            $note = '';
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-' . auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });

            $lists = ListViewModel::lists($requestedName);

            $note = $requestedName->getNoteForUser();
        }

        return view('names.show', [
            'name' => $name,
            'popularity' => $popularity,
            'relatedNames' => $relatedNames,
            'jsonLdSchema' => NameViewModel::jsonLdSchema($requestedName),
            'numerology' => $numerology,
            'favorites' => $favoritedNamesForLoggedUser,
            'lists' => $lists,
            'note' => $note,
        ]);
    }

    public function letter(Request $request): View
    {
        $requestedLetter = $request->attributes->get('letter');
        $requestedPage = $request->query('page') ?? 1;

        $letters = Cache::remember('all-letters', 604800, function () {
            return AllNamesViewModel::index();
        });

        Paginator::currentPageResolver(function () use ($requestedPage) {
            return $requestedPage;
        });

        $namesPagination = Cache::remember('letter-' . $requestedLetter . '-page-' . $requestedPage, 604800, function () use ($requestedLetter) {
            return Name::where('name', '!=', '_PRENOMS_RARES')
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

        return view('names.letter', [
            'letters' => $letters,
            'names' => $names,
            'namesPagination' => $namesPagination,
            'activeLetter' => Str::ucfirst($requestedLetter),
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }

    public function storeNameInList(Request $request, int $listId, int $nameId): View
    {
        $requestedList = $request->attributes->get('list');

        (new ToggleNameToNameList(
            nameId: $nameId,
            listId: $requestedList->id,
        ))->execute();

        Cache::forget('list-details-' . $requestedList->id);
        Cache::forget('user-lists-' . auth()->id());

        $list = ListViewModel::getListDetail($requestedList, Name::find($nameId));

        return view('names.partials.lists', [
            'list' => $list,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\Favorited;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Services\ToggleNameToFavorites;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $favorites = Cache::remember('user-favorites-details-' . auth()->id(), 604800, fn () => UserViewModel::index());

        return view('user.index', [
            'names' => $favorites['names'],
        ]);
    }

    public function update(Request $request): View
    {
        $name = $request->attributes->get('name');

        $favorited = (new ToggleNameToFavorites(
            nameId: $name->id,
        ))->execute();

        Favorited::dispatch($request->user(), $name);

        Cache::forget('user-favorites-' . auth()->id());
        Cache::forget('user-favorites-details-' . auth()->id());

        return view('components.name-items', [
            'name' => NameViewModel::summary($name),
            'favorited' => $favorited,
        ]);
    }
}

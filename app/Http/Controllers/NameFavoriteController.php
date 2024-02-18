<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\NameViewModel;
use App\Services\ToggleNameToFavorites;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NameFavoriteController extends Controller
{
    public function update(Request $request): View
    {
        $name = $request->attributes->get('name');

        $favorited = (new ToggleNameToFavorites(
            nameId: $name->id,
        ))->execute();

        Cache::forget('user-favorites-' . auth()->id());
        Cache::forget('user-favorites-details-' . auth()->id());

        return view('components.favorite', [
            'name' => NameViewModel::details($name),
            'favorited' => $favorited,
        ]);
    }
}

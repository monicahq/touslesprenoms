<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ToggleNameToFavorites;
use Illuminate\Http\RedirectResponse;
use Request;

class FavoriteController extends Controller
{
    public function update(Request $request)
    {
        (new ToggleNameToFavorites(
            nameId: $request->attributes->get('name')->id,
        ))->execute();
    }
}

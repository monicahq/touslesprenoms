<?php

namespace App\Http\Controllers;

use App\Services\ToggleNameToFavorites;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function update(Request $request): void
    {
        (new ToggleNameToFavorites(
            nameId: $request->attributes->get('name')->id,
        ))->execute();
    }
}

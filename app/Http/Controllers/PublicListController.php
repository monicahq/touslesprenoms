<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\User\PublicListViewModel;
use App\Http\ViewModels\User\UserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicListController extends Controller
{
    public function show(Request $request): View
    {
        $requestedList = $request->attributes->get('list');

        $details = PublicListViewModel::show($requestedList);

        $favoritedNamesForLoggedUser = auth()->check()
            ? Cache::remember('user-favorites-' . auth()->id(), 604800, fn () => UserViewModel::favorites())
            : collect();

        return view('user.lists.public.show', [
            'list' => $details,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

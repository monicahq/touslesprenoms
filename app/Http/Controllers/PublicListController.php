<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\User\ListViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Services\CreateList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PublicListController extends Controller
{
    public function show(Request $request): View
    {
        $requestedList = $request->attributes->get('list');

        $details = Cache::remember('list-details-' . $requestedList->id, 604800, function () use ($requestedList) {
            return ListViewModel::show($requestedList);
        });

        if (! auth()->check()) {
            $favoritedNamesForLoggedUser = collect();
        } else {
            $favoritedNamesForLoggedUser = Cache::remember('user-favorites-' . auth()->id(), 604800, function () {
                return UserViewModel::favorites();
            });
        }

        return view('user.lists.public.show', [
            'list' => $details,
            'favorites' => $favoritedNamesForLoggedUser,
        ]);
    }
}

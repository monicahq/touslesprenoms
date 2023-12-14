<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NameController extends Controller
{
    public function show(Request $request): View
    {
        $requestedName = $request->attributes->get('name');

        $name = Cache::remember('name-'.$requestedName->name, 604800, function () use ($requestedName) {
            return NameViewModel::details($requestedName);
        });

        $relatedNames = Cache::remember('related-names-'.$requestedName->name, 60, function () use ($requestedName) {
            return NameViewModel::relatedNames($requestedName);
        });

        return view('names.show', [
            'name' => $name,
            'relatedNames' => $relatedNames,
            'jsonLdSchema' => NameViewModel::jsonLdSchema($requestedName),
        ]);
    }
}

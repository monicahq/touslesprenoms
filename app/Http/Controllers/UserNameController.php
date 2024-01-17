<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Http\ViewModels\Names\NameViewModel;
use App\Services\AddNoteToName;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserNameController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $name = $request->attributes->get('name');

        (new AddNoteToName(
            nameId: $name->id,
            userId: auth()->id(),
            noteText: $request->input('note'),
        ))->execute();

        return Redirect::route('name.show', [
            'id' => $name->id,
            'name' => StringHelper::sanitizeNameForURL($name->name),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SettingsProfileController extends Controller
{
    public function index(): View
    {
        return view('settings.profile.index');
    }
}

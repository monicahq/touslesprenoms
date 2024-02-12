<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\Names\MaleNamesViewModel;
use App\Http\ViewModels\Names\NameViewModel;
use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TermsController extends Controller
{
    public function index(): View
    {
        return view('terms.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TermsController extends Controller
{
    public function index(): View
    {
        return view('terms.index');
    }
}

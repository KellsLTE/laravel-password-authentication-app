<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MagicLoginController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.magic.login');
    }
}

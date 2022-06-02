<?php

namespace App\Http\Controllers;

use App\Auth\MagicAuthentication;
use Illuminate\Http\Request;

class MagicLoginController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.magic.login');
    }

    public function sendToken(Request $request, MagicAuthentication $auth) 
    {
        $this->validateLogin($request);

        $auth->requestlink();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|max:255|exists:users,email"
        ]);
    }
}

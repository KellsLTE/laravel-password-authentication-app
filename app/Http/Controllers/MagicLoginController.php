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

        return redirect()->to('/login/magic')->withMessage("We've sent you a magic link!");
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|max:255|exists:users,email"
        ]);
    }
}

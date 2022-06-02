<?php

namespace App\Http\Controllers;

use App\Auth\MagicAuthentication;
use App\Models\UserLoginToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->to('/login/magic')->withSuccess("We've sent you a magic link!");
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|max:255|exists:users,email"
        ]);
    }

    public function validateToken(Request $request, UserLoginToken $token)
    {
        $token->delete();
        
        if ($token->isExpired()) {
            
            return redirect()->to('/login/magic')->withError("That magic link has expired");
        }

        if (!$token->belongsToEmail($request->email)) {

            return redirect()->to('/login/magic')->withError("Invalid magic link");
        
        }
        
        Auth::login($token->user, $request->remeber);

        return redirect()->intended();
    }
}

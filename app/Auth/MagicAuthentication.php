<?php
namespace App\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class MagicAuthentication
{
    protected $request;

    protected $identifier = 'email';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestlink()
    {
        $user = $this->getUserByIdentifier($this->request->get($this->identifier));

        $user->storeToken()->sendMagicLink([
            'remember' => $this->request->has('remember'),
            'email' => $user->email
        ]);
    }

    protected function getUserByIdentifier($value)
    {
        return User::where($this->identifier, $value)->firstOrFail();
    }

}
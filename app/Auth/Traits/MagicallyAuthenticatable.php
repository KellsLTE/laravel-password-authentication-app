<?php
namespace App\Auth\Traits;

use Illuminate\Support\Str;
use App\Models\UserLoginToken;

trait MagicallyAuthenticatable
{
    
    public function storeToken()
    {
        $this->token()->delete();
        
        $this->token()->create([
            'token' => Str::random(255),
        ]);

        return $this;
    }

    public function token()
    {
        return $this->hasOne(UserLoginToken::class);
    }
}
<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginToken extends Model
{
    use HasFactory;

    const TOKEN_EXPIRY = 30;

    protected $table = "users_login_tokens";

    protected $fillable = ['token'];

    public function isExpired()
    {
        return $this->created_at->diffInSeconds(Carbon::now()) > self::TOKEN_EXPIRY;
    }

    public function belongsToEmail($email)
    {
        return (bool) ($this->user->where('email', $email)->count() === 1);
    }

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

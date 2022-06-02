<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginToken extends Model
{
    use HasFactory;

    protected $table = "users_login_tokens";

    protected $fillable = ['token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedLoginAttempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email_address',
        'ip_address',
    ];

    public static function record($user = null, $email, $ip)
    {
        return static::create([
            'user_id' => is_null($user) ? null : $user->id,
            'email_address' => $email,
            'ip_address' => $ip,
        ]);
    }
}

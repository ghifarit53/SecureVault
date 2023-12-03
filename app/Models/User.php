<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'fullname',
        'country_code',
        'province',
        'city',
        'password',
        'private_key',
        'public_key',
        'certificate',
    ];

    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'password' => 'hashed',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function hasPendingRequestFor($user)
    {
        return UserRequest::where('sender_id', Auth::user()->id)
            ->where('target_id', $user->id)
            ->where('status', 0)
            ->exists();
    }

    public function hasAcceptedRequestFor($user)
    {
        return UserRequest::where('sender_id', Auth::user()->id)
            ->where('target_id', $user->id)
            ->where('status', 1)
            ->exists();
    }

    public function incomingUserRequest($user)
    {
        return UserRequest::where('sender_id', Auth::user()->id)
            ->where('target_id', $user->id)
            ->first();;
    }
}

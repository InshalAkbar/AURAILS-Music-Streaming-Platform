<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_address',
        'user_phone',
        'user_image',
        'user_role',
        'user_remember_token',
    ];

    protected $hidden = [
        'user_password',
        'user_remember_token',
    ];

    /**
     * Override password field name
     */
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    /**
     * Override remember token field name
     */
    public function getRememberTokenName()
    {
        return 'user_remember_token';
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'review_user_id');
    }

    public function isAdmin(): bool
    {
        return $this->user_role === 'admin';
    }
}
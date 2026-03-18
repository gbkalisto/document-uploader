<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

    protected $guard = 'admin';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'profile_picture',
        'status'
    ];

    // Hide password and remember token from arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

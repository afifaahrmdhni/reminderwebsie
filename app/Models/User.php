<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'photo', 'password', 'is_active', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // setiap user punya 1 role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

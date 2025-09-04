<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',        // nomor telepon
        'password',
        'role_id',      // level 1–3
        'is_active'     // aktif / nonaktif
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function logs()
    {
        return $this->hasMany(ReminderLog::class, 'performed_by');
    }

    // Scope cepat ambil user aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi mass-assignment
     */
    protected $fillable = [
        'name',
        'email',
        'phone',     // nomor telepon
        'password',
        'role_id',   // relasi ke tabel roles
        'is_active', // status aktif / nonaktif
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom ke tipe data tertentu
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    /**
     * Relasi: User belongsTo Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi: User hasMany Reminder
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Relasi: User hasMany ReminderLog
     */
    public function logs()
    {
        return $this->hasMany(ReminderLog::class, 'performed_by');
    }

    /**
     * Scope: Ambil user yang aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor: Konversi role_id ke nama role
     */
    public function getRoleNameAttribute(): string
    {
        return match ($this->role_id) {
            1       => 'Super User',
            2       => 'Multi User',
            3       => 'Basic User',
            default => 'Unknown',
        };
    }
}

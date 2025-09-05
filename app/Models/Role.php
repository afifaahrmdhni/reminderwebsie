<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',       // nama role (Admin, User, dll)
        'level',      // angka 1/2/3
        'description' // keterangan
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function role()
{
    return $this->belongsTo(Role::class);
}
}

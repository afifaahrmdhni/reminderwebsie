<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // 1 role bisa dipakai banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

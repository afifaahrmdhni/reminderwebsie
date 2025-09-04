<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reminder;    

class ReminderCategory extends Model
{
    protected $fillable = ['name', 'icon'];

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'category_id');
    }
}

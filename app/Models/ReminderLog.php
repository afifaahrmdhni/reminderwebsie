<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reminder;
use App\Models\User;

class ReminderLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['reminder_id', 'action', 'performed_by', 'timestamp'];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}

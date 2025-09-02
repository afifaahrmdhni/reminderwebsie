<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reminder;

class Notification extends Model
{
    public $timestamps = false;

    protected $fillable = ['reminder_id', 'channel', 'status', 'sent_at'];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class);
    }
}
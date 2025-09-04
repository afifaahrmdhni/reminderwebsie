<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReminderCategory;
use App\Models\User;
use App\Models\ReminderLog;
use App\Models\Notification;

class Reminder extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'due_date',
        'status',
        'priority',
        'recipient_emails',
        'recipient_phones'
    ];

    protected $casts = [
        'recipient_emails' => 'array',
        'recipient_phones' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ReminderCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(ReminderLog::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
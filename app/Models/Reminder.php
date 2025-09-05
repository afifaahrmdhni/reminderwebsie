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
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'due_date',
        'recipient_emails',
        'recipient_phones',
    ];

    protected $casts = [
        'recipient_emails' => 'array',
        'recipient_phones' => 'array',
        'due_date'         => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(ReminderCategory::class, 'category_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ⬅️ tambahin ini

class Reminder extends Model
{
    use HasFactory, SoftDeletes; // ⬅️ tambahin SoftDeletes

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'category_id',
        'recipient_emails',
        'recipient_phones',
    ];

    protected $casts = [
        'recipient_emails' => 'array',
        'recipient_phones' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(ReminderCategory::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class ChatMessage extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text',
        'is_read'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function getCreatedAtFormattedAttribute(): string
    {
        return Carbon::parse($this->attributes['created_at'])->format('h:i A'); // For example: "2:30 PM"
    }

    // Optionally, you can also add a relative time format
    public function getCreatedAtRelativeAttribute(): string
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans(); // For example: "3 minutes ago"
    }
}

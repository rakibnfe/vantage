<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'visitor_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'budget',
        'timeline',
        'status',
        'ip_address',
        'user_agent',
        'source_page',
        'notes',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'status' => 'string',
    ];

    // Relationships
    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class)->withDefault();
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(\Spatie\ActivityLog\Models\Activity::class, 'subject');
    }

    // Activity Log Options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'email',
                'subject',
                'message',
                'status',
                'notes',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('status', '!=', 'read')->where('status', '!=', 'replied');
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Methods
    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function markAsReplied(): void
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now(),
        ]);
    }

    public function markAsSpam(): void
    {
        $this->update(['status' => 'spam']);
    }

    public function markAsClosed(): void
    {
        $this->update(['status' => 'closed']);
    }

    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    public function isUnread(): bool
    {
        return !in_array($this->status, ['read', 'replied']);
    }
}

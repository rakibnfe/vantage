<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'status',
        'start_time',
        'end_time',
        'is_all_day',
        'is_recurring',
        'recurrence_pattern',
        'recurrence_days',
        'recurrence_until',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_notes',
        'metadata',
        'color',
        'location',
        'user_id',
        'service_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'recurrence_until' => 'date',
        'is_all_day' => 'boolean',
        'is_recurring' => 'boolean',
        'recurrence_days' => 'array',
        'metadata' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'start_time', 'end_time'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now())
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->orderBy('start_time');
    }

    public function scopePast($query)
    {
        return $query->where('end_time', '<', now())
            ->orWhere('status', 'completed')
            ->orderByDesc('start_time');
    }

    public function scopeByDateRange($query, $start, $end)
    {
        return $query->where(function ($q) use ($start, $end) {
            $q->whereBetween('start_time', [$start, $end])
              ->orWhereBetween('end_time', [$start, $end])
              ->orWhere(function ($q2) use ($start, $end) {
                  $q2->where('start_time', '<=', $start)
                     ->where('end_time', '>=', $end);
              });
        });
    }

    public function scopeAppointments($query)
    {
        return $query->where('type', 'appointment');
    }

    public function scopeAvailable($query)
    {
        return $query->where('type', 'availability');
    }

    public function scopeBlocked($query)
    {
        return $query->where('type', 'blocked');
    }

    public function getDurationAttribute(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    public function getFormattedDurationAttribute(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($hours > 0 && $minutes > 0) {
            return "{$hours}h {$minutes}m";
        } elseif ($hours > 0) {
            return "{$hours}h";
        }
        
        return "{$minutes}m";
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'confirmed' => 'green',
            'cancelled' => 'red',
            'completed' => 'blue',
            default => 'yellow'
        };
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'appointment' => '#4f46e5', // primary
            'availability' => '#10b981', // green
            'blocked' => '#ef4444', // red
            default => '#6b7280' // gray
        };
    }
}
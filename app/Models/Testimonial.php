<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'client_name',
        'client_role',
        'client_company',
        'client_avatar',
        'content',
        'rating',
        'project_name',
        'project_link',
        'is_featured',
        'is_published',
        'order',
        'video_url',
        'social_links',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'order' => 'integer',
        'social_links' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'client_name',
                'client_role',
                'content',
                'rating',
                'is_featured',
                'is_published',
                'order',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function scopeHighRating($query, $minRating = 4)
    {
        return $query->where('rating', '>=', $minRating);
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->client_name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->client_name, 0, 2));
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->client_avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->client_name) . '&background=4f46e5&color=fff';
    }

    public function getFormattedRatingAttribute(): string
    {
        return number_format($this->rating, 1);
    }
}
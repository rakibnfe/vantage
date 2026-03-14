<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'featured_image',
        'description',
        'images',
        'overview',
        'challenge',
        'solution',
        'results',
        'technologies',
        'live_url',
        'github_url',
        'case_study_url',
        'start_date',
        'end_date',
        'status',
        'is_featured',
        'is_published',
        'published_at',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'technologies' => 'array',
        'images' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   
    public function offerings(): BelongsToMany
    {
        return $this->belongsToMany(Offering::class, 'offering_project')->withTimestamps();
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function featuredImage(): MorphOne
    {
        return $this->morphOne(\Spatie\MediaLibrary\MediaCollections\Models\Media::class, 'model')
            ->where('collection_name', 'featured_image');
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(\Spatie\ActivityLog\Models\Activity::class, 'subject');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title',
                'slug',
                'description',
                'status',
                'is_featured',
                'is_published',
                'published_at',
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
        return $query->orderBy('order');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function getTechnologiesList(): array
    {
        if (is_string($this->technologies)) {
            return json_decode($this->technologies, true) ?? [];
        }
        
        return $this->technologies ?? [];
    }

    public function getDurationInDays(): ?int
    {
        if ($this->start_date && $this->end_date) {
            return $this->end_date->diffInDays($this->start_date);
        }
        return null;
    }
}
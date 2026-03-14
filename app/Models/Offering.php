<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Offering extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'icon',
        'overview',
        'description',
        'meta_title',
        'meta_description',
        'order',
        'is_published',
        'is_highlighted',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_highlighted' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        // static::creating(function ($offering) {
        //     if (auth()->check()) {
        //         $offering->user_id = auth()->id();
        //     }
        // });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(150)
                    ->height(150)
                    ->sharpen(10);
                
                $this->addMediaConversion('preview')
                    ->width(800)
                    ->height(600);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10);
        
        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600);
    }

    public function features(): HasMany
    {
        return $this->hasMany(OfferingFeature::class);
    }

    public function processSteps(): HasMany
    {
        return $this->hasMany(OfferingProcessStep::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(OfferingFAQ::class);
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(OfferingTechnology::class);
    }

    public function pricingModels(): HasMany
    {
        return $this->hasMany(OfferingPricingModel::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'offering_project')
            ->withTimestamps();
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(\Spatie\ActivityLog\Models\Activity::class, 'subject');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title',
                'slug',
                'overview',
                'is_published',
                'is_highlighted',
                'published_at',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeHighlighted($query)
    {
        return $query->where('is_highlighted', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getFeaturedImageUrl(string $conversion = ''): string
    {
        if ($this->getFirstMedia('featured_image')) {
            return $this->getFirstMedia('featured_image')->getUrl($conversion);
        }
        
        return asset('images/placeholder-offering.jpg');
    }

    public function getTechnologiesList(): array
    {
        return $this->technologies()->pluck('name')->toArray();
    }

    public function getRelatedProjects()
    {
        return $this->projects()->get();
    }
}
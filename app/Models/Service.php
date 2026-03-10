<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'icon',
        'featured_image',
        'overview',
        'description',
        'process',
        'features',
        'technologies',
        'pricing_models',
        'faqs',
        'success_stories',
        'delivery_timeframe',
        'team_size',
        'consultation_url',
        'related_projects',
        'meta_title',
        'meta_description',
        'order',
        'is_published',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'process' => 'json',
        'features' => 'json',
        'technologies' => 'json',
        'pricing_models' => 'json',
        'faqs' => 'json',
        'related_projects' => 'json',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function features(): HasMany
    {
        return $this->hasMany(ServiceFeature::class);
    }

    public function processSteps(): HasMany
    {
        return $this->hasMany(ServiceProcessStep::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFAQ::class);
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(ServiceTechnology::class);
    }

    public function pricingModels(): HasMany
    {
        return $this->hasMany(ServicePricingModel::class);
    }

   public function projects(): BelongsToMany
{
    return $this->belongsToMany(Project::class, 'service_project')
                ->withTimestamps(); 
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

    // Activity Log Options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title',
                'slug',
                'overview',
                'is_published',
                'is_featured',
                'published_at',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Scopes
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

    public function scopeWithRelations($query)
    {
        return $query->with(['features', 'processSteps', 'faqs', 'technologies', 'pricingModels']);
    }

    // Methods
    public function getTechnologiesList(): array
    {
        return $this->technologies()->pluck('name')->toArray();
    }

    public function getRelatedProjects()
    {
        return $this->projects()->get();
    }
}

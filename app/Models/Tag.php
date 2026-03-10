<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    public function projects(): MorphToMany
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }

    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function services(): MorphToMany
    {
        return $this->morphedByMany(Service::class, 'taggable');
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('projects', 'articles', 'services')
                     ->orderBy('projects_count', 'desc')
                     ->limit($limit);
    }
}

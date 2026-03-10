<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTechnology extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'icon',
        'category',
        'url',
        'order',
    ];
    protected $table = 'service_technologies';

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}

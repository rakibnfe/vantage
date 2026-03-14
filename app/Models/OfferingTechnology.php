<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingTechnology extends Model
{
    use HasFactory;

    protected $fillable = [
        'offering_id',
        'name',
        'icon',
        'category',
        'url',
        'order',
    ];
    
    protected $table = 'offering_technologies';

    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class);
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
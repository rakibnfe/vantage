<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingPricingModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'offering_id',
        'name',
        'description',
        'price',
        'duration',
        'features',
        'is_popular',
        'order',
    ];
    
    protected $table = 'offering_pricing_models';

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_popular' => 'boolean',
    ];

    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getFormattedPriceAttribute(): string
    {
        return $this->price ? '$' . number_format($this->price, 2) : 'Custom';
    }
}
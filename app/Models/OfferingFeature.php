<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'offering_id',
        'title',
        'description',
        'icon',
        'order',
    ];
    
    protected $table = 'offering_features';
    
    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
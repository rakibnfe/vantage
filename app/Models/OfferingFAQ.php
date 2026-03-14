<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingFAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'offering_id',
        'question',
        'answer',
        'order',
    ];
    
    protected $table = 'offering_faqs';

    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
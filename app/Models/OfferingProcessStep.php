<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'offering_id',
        'title',
        'description',
        'icon',
        'duration',
        'order',
    ];
    
    protected $table = 'offering_process_steps';
    
    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'description',
        'icon',
        'duration',
        'order',
    ];
protected $table = 'service_process_steps';
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}

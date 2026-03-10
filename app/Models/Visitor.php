<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'browser',
        'os',
        'device',
        'country',
        'city',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'first_visit_at',
        'last_visit_at',
        'visit_count',
        'page_view_count',
        'total_time_spent',
    ];

    protected $casts = [
        'first_visit_at' => 'datetime',
        'last_visit_at' => 'datetime',
    ];

    // Relationships
    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function toolUsages(): HasMany
    {
        return $this->hasMany(ToolUsage::class);
    }

    // Scopes
    public function scopeRecentVisitors($query, $days = 7)
    {
        return $query->where('last_visit_at', '>=', now()->subDays($days));
    }

    public function scopeMostActive($query, $limit = 10)
    {
        return $query->orderByDesc('page_view_count')->limit($limit);
    }

    public function scopeByCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('last_visit_at', today());
    }

    public function scopeByDevice($query, $device)
    {
        return $query->where('device', $device);
    }

    // Methods
    public function getBrowserInfo(): string
    {
        return $this->browser ? "{$this->browser} on {$this->os}" : 'Unknown';
    }

    public function getDeviceInfo(): string
    {
        return $this->device ?? 'Unknown';
    }

    public function getLocationInfo(): string
    {
        $location = [];
        if ($this->city) $location[] = $this->city;
        if ($this->country) $location[] = $this->country;
        return implode(', ', $location) ?: 'Unknown';
    }

    public function getAverageSessionDuration(): int
    {
        return $this->visit_count > 0 ? intval($this->total_time_spent / $this->visit_count) : 0;
    }

    public function recordVisit(): void
    {
        $this->increment('visit_count');
        $this->update(['last_visit_at' => now()]);
    }
}

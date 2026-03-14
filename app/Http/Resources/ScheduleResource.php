<?php
// app/Http/Resources/ScheduleResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status,
            'status_color' => $this->status_color,
            'start_time' => $this->start_time->toISOString(),
            'end_time' => $this->end_time->toISOString(),
            'formatted_start' => $this->start_time->format('M j, Y g:i A'),
            'formatted_end' => $this->end_time->format('M j, Y g:i A'),
            'formatted_date' => $this->start_time->format('l, F j, Y'),
            'formatted_time' => $this->start_time->format('g:i A') . ' - ' . $this->end_time->format('g:i A'),
            'is_all_day' => $this->is_all_day,
            'duration' => $this->duration,
            'formatted_duration' => $this->formatted_duration,
            'is_recurring' => $this->is_recurring,
            'recurrence_pattern' => $this->recurrence_pattern,
            'recurrence_days' => $this->recurrence_days,
            'recurrence_until' => $this->recurrence_until?->toISOString(),
            'customer' => $this->when($this->customer_name, [
                'name' => $this->customer_name,
                'email' => $this->customer_email,
                'phone' => $this->customer_phone,
                'notes' => $this->customer_notes,
            ]),
            'color' => $this->color ?? $this->type_color,
            'location' => $this->location,
            'metadata' => $this->metadata,
            'user' => $this->whenLoaded('user', function() {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
            'offering' => $this->whenLoaded('offering', function() {
                return [
                    'id' => $this->offering->id,
                    'title' => $this->offering->title,
                    'slug' => $this->offering->slug,
                ];
            }),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
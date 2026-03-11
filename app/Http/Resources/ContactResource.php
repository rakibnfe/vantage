<?php
// app/Http/Resources/ContactResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'budget' => $this->budget,
            'timeline' => $this->timeline,
            'status' => $this->status,
            'status_label' => ucfirst($this->status),
            'status_color' => $this->getStatusColor(),
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'source_page' => $this->source_page,
            'notes' => $this->notes,
            'replied_at' => $this->replied_at?->toISOString(),
            'formatted_replied_at' => $this->replied_at?->format('M j, Y g:i A'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'formatted_created_at' => $this->created_at?->format('M j, Y g:i A'),
            'formatted_date' => $this->created_at?->format('M j, Y'),
            'formatted_time' => $this->created_at?->format('g:i A'),
            
            'visitor' => $this->whenLoaded('visitor', function() {
                return [
                    'id' => $this->visitor->id,
                    'ip_address' => $this->visitor->ip_address,
                    'visit_count' => $this->visitor->visit_count,
                    'first_visit' => $this->visitor->first_visit?->toISOString(),
                    'last_visit' => $this->visitor->last_visit?->toISOString(),
                ];
            }),

            'is_new' => $this->isNew(),
            'is_unread' => $this->isUnread(),
        ];
    }

    private function getStatusColor(): string
    {
        return match($this->status) {
            'new' => '#ef4444',     // red
            'read' => '#f59e0b',     // amber
            'replied' => '#10b981',  // green
            'closed' => '#6b7280',   // gray
            'spam' => '#000000',     // black
            default => '#6b7280',
        };
    }
}
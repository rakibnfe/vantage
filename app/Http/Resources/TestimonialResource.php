<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'client_role' => $this->client_role,
            'client_company' => $this->client_company,
            'client_avatar' => $this->avatar_url,
            'initials' => $this->initials,
            'content' => $this->content,
            'rating' => $this->rating,
            'formatted_rating' => $this->formatted_rating,
            'project_name' => $this->project_name,
            'project_link' => $this->project_link,
            'video_url' => $this->video_url,
            'social_links' => $this->social_links,
            'is_featured' => $this->is_featured,
            'order' => $this->order,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            
            'urls' => [
                'project' => $this->project_link,
                'video' => $this->video_url,
            ],
        ];
    }
}
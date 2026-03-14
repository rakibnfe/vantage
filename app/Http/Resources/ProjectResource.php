<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'featured_image' => $this->featured_image,
            'images' => $this->images,
            'overview' => $this->overview,
            'challenge' => $this->challenge,
            'solution' => $this->solution,
            'results' => $this->results,
            'technologies' => $this->technologies,
            'live_url' => $this->live_url,
            'github_url' => $this->github_url,
            'case_study_url' => $this->case_study_url,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'status' => $this->status,
            'status_label' => ucfirst(str_replace('_', ' ', $this->status)),
            'is_featured' => $this->is_featured,
            'order' => $this->order,
            'published_at' => $this->published_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
            'tags' => $this->whenLoaded('tags', fn() => TagResource::collection($this->tags)),
            'offerings' => $this->whenLoaded('offerings', fn() => OfferingResource::collection($this->offerings)),
            'duration_days' => $this->getDurationInDays(),
            'technologies_list' => $this->getTechnologiesList(),
        ];
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'excerpt' => $this->excerpt,
            'content' => $this->when($request->routeIs('*.show'), $this->content),
            'featured_image' => $this->featured_image,
            'reading_time' => $this->reading_time ?? $this->getEstimatedReadingTime(),
            'is_published' => $this->is_published,
            'published_at' => $this->published_at?->toISOString(),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),

            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
            'category' => $this->whenLoaded('category', fn() => new CategoryResource($this->category)),
            'tags' => $this->whenLoaded('tags', fn() => TagResource::collection($this->tags)),
        ];
    }
}
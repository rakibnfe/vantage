<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'color' => $this->color,
            'description' => $this->description,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'counts' => [
                'projects' => $this->when(isset($this->projects_count), $this->projects_count, 0),
                'articles' => $this->when(isset($this->articles_count), $this->articles_count, 0),
                'offerings' => $this->when(isset($this->offerings_count), $this->offerings_count, 0),
            ],
            'projects' => $this->whenLoaded('projects', fn() => ProjectResource::collection($this->projects)),
            'articles' => $this->whenLoaded('articles', fn() => ArticleResource::collection($this->articles)),
            'offerings' => $this->whenLoaded('offerings', fn() => OfferingResource::collection($this->offerings)),
        ];
    }
}
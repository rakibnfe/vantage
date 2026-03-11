<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'description' => $this->description,
            'color' => $this->color,
            'icon' => $this->icon,
            'order' => $this->order,
            'articles_count' => $this->when(isset($this->articles_count), $this->articles_count, 0),
            'articles' => $this->whenLoaded('articles', fn() => ArticleResource::collection($this->articles)),
        ];
    }
}
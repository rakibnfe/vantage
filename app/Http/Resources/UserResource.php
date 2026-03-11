<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->when($request->user()?->id === $this->id, $this->email),
            'role' => $this->role,
            'bio' => $this->bio,
            'profile_picture' => $this->profile_picture,
            'created_at' => $this->created_at?->toISOString(),
            'articles' => $this->whenLoaded('articles', fn() => ArticleResource::collection($this->articles)),
            'projects' => $this->whenLoaded('projects', fn() => ProjectResource::collection($this->projects)),
        ];
    }
}
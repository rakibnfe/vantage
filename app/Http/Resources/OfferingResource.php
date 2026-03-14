<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferingResource extends JsonResource
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
            'tagline' => $this->tagline,
            'icon' => $this->icon ?? 'code-bracket',
            'featured_image' => $this->featured_image,
            'overview' => $this->overview,
            'description' => $this->description ?? $this->overview,
            'success_stories' => $this->success_stories,
            'delivery_timeframe' => $this->delivery_timeframe,
            'team_size' => $this->team_size,
            'consultation_url' => $this->consultation_url,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_highlighted' => $this->is_highlighted,
            'order' => $this->order,
            'category' => $this->category ?? 'general',
            'price' => $this->price ?? 'Custom Pricing',
            'published_at' => $this->published_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'features' => $this->whenLoaded('features', fn() => FeatureResource::collection($this->features)),
            'process_steps' => $this->whenLoaded('processSteps', fn() => ProcessStepResource::collection($this->processSteps)),
            'faqs' => $this->whenLoaded('faqs', fn() => FAQResource::collection($this->faqs)),
            'technologies' => $this->whenLoaded('technologies', fn() => TechnologyResource::collection($this->technologies)),
            'pricing_models' => $this->whenLoaded('pricingModels', fn() => PricingModelResource::collection($this->pricingModels)),
            'projects' => $this->whenLoaded('projects', fn() => ProjectResource::collection($this->projects)),
            'tags' => $this->whenLoaded('tags', fn() => TagResource::collection($this->tags)),
        ];
    }
}
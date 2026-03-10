<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Check if resource is null
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'slug' => $this->slug ?? '',
            'tagline' => $this->tagline ?? '',
            'icon' => $this->icon ?? 'code-bracket',
            'featured_image' => $this->featured_image,
            'overview' => $this->overview ?? '',
            'description' => $this->description ?? $this->overview ?? '',
            'success_stories' => $this->success_stories,
            'delivery_timeframe' => $this->delivery_timeframe,
            'team_size' => $this->team_size,
            'consultation_url' => $this->consultation_url,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_featured' => $this->is_featured ?? false,
            'order' => $this->order ?? 0,
            'category' => $this->category ?? 'general',
            'price' => $this->price ?? 'Custom Pricing',
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            
            // Relationships with null checks
            'features' => $this->whenLoaded('features', function() {
                return FeatureResource::collection($this->features);
            }, []),
            
            'process_steps' => $this->whenLoaded('processSteps', function() {
                return ProcessStepResource::collection($this->processSteps);
            }, []),
            
            'faqs' => $this->whenLoaded('faqs', function() {
                return FAQResource::collection($this->faqs);
            }, []),
            
            'technologies' => $this->whenLoaded('technologies', function() {
                return TechnologyResource::collection($this->technologies);
            }, []),
            
            'pricing_models' => $this->whenLoaded('pricingModels', function() {
                return PricingModelResource::collection($this->pricingModels);
            }, []),
            
            'projects' => $this->whenLoaded('projects', function() {
                return ProjectResource::collection($this->projects);
            }, []),
            
            'tags' => $this->whenLoaded('tags', function() {
                return TagResource::collection($this->tags);
            }, []),
        ];
    }
}
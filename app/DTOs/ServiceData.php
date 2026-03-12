<?php

namespace App\DTOs;

use App\Enums\ServiceStatus;
use Illuminate\Http\UploadedFile;

class ServiceData
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $tagline,
        public readonly ?string $icon,
        public readonly ?UploadedFile $featuredImage,
        public readonly string $overview,
        public readonly ?string $description,
        public readonly ?string $metaTitle,
        public readonly ?string $metaDescription,
        public readonly ServiceStatus $status,
        public readonly bool $isFeatured,
        public readonly int $order,
        public readonly array $features,
        public readonly array $processSteps,
        public readonly array $faqs,
        public readonly array $technologies,
        public readonly array $pricingModels,
        public readonly array $projectIds,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            title: $validated['title'],
            slug: $validated['slug'] ?? str($validated['title'])->slug(),
            tagline: $validated['tagline'],
            icon: $validated['icon'] ?? null,
            featuredImage: $validated['featured_image'] ?? null,
            overview: $validated['overview'],
            description: $validated['description'] ?? null,
            metaTitle: $validated['meta_title'] ?? null,
            metaDescription: $validated['meta_description'] ?? null,
            status: ServiceStatus::from($validated['status'] ?? 'draft'),
            isFeatured: $validated['is_featured'] ?? false,
            order: $validated['order'] ?? 0,
            features: $validated['features'] ?? [],
            processSteps: $validated['process_steps'] ?? [],
            faqs: $validated['faqs'] ?? [],
            technologies: $validated['technologies'] ?? [],
            pricingModels: $validated['pricing_models'] ?? [],
            projectIds: $validated['project_ids'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'tagline' => $this->tagline,
            'icon' => $this->icon,
            'overview' => $this->overview,
            'description' => $this->description,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'is_published' => $this->status === ServiceStatus::PUBLISHED,
            'is_featured' => $this->isFeatured,
            'order' => $this->order,
        ];
    }
}
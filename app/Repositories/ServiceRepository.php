<?php

namespace App\Repositories;

use App\Models\Service;
use App\DTOs\ServiceData;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ServiceRepository extends BaseRepository
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
    }

    public function paginateWithFilters(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $cacheKey = 'services:' . md5(json_encode($filters) . $perPage . request('page', 1));
        
        return Cache::tags(['services'])->remember($cacheKey, 3600, function () use ($filters, $perPage) {
            $query = $this->model->select('services.*')->withCount([
                'projects',
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels'
            ])->with([
                'projects' => fn($q) => $q->select('projects.id', 'projects.title', 'projects.slug')
            ]);

            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('services.title', 'like', "%{$filters['search']}%")
                      ->orWhere('services.tagline', 'like', "%{$filters['search']}%")
                      ->orWhere('services.overview', 'like', "%{$filters['search']}%");
                });
            }

            if (isset($filters['status']) && $filters['status'] !== '') {
                $query->where('services.is_published', $filters['status'] === 'published');
            }

            if (isset($filters['is_featured'])) {
                $query->where('services.is_featured', $filters['is_featured']);
            }

            $sortField = $filters['sort_field'] ?? 'order';
            $sortDirection = $filters['sort_direction'] ?? 'asc';

            $query->orderBy('services.' . $sortField, $sortDirection);

            return $query->paginate($perPage);
        });
    }

    public function createFromDTO(ServiceData $dto): Service
    {
        return DB::transaction(function () use ($dto) {
            $service = $this->model->create($dto->toArray());

            if ($dto->featuredImage) {
                $service->addMedia($dto->featuredImage)
                    ->toMediaCollection('featured_image');
            }

            $this->syncRelations($service, $dto);

            Cache::tags(['services'])->flush();

            return $service->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ]);
        });
    }

    public function updateFromDTO(Service $service, ServiceData $dto): Service
    {
        return DB::transaction(function () use ($service, $dto) {
            $service->update($dto->toArray());

            if ($dto->featuredImage) {
                $service->clearMediaCollection('featured_image');
                $service->addMedia($dto->featuredImage)
                    ->toMediaCollection('featured_image');
            }

            $this->syncRelations($service, $dto);

            Cache::tags(['services'])->flush();

            return $service->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ]);
        });
    }

    protected function syncRelations(Service $service, ServiceData $dto): void
    {
        $service->features()->delete();
        foreach ($dto->features as $index => $feature) {
            $service->features()->create([
                'title' => $feature['title'],
                'description' => $feature['description'] ?? null,
                'icon' => $feature['icon'] ?? null,
                'order' => $feature['order'] ?? $index,
            ]);
        }

        $service->processSteps()->delete();
        foreach ($dto->processSteps as $index => $step) {
            $service->processSteps()->create([
                'title' => $step['title'],
                'description' => $step['description'] ?? null,
                'icon' => $step['icon'] ?? null,
                'order' => $step['order'] ?? $index,
            ]);
        }

        $service->faqs()->delete();
        foreach ($dto->faqs as $index => $faq) {
            $service->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $faq['order'] ?? $index,
            ]);
        }

        $service->technologies()->delete();
        foreach ($dto->technologies as $index => $tech) {
            $service->technologies()->create([
                'name' => $tech['name'],
                'icon' => $tech['icon'] ?? null,
                'order' => $tech['order'] ?? $index,
            ]);
        }

        $service->pricingModels()->delete();
        foreach ($dto->pricingModels as $index => $pricing) {
            $service->pricingModels()->create([
                'name' => $pricing['name'],
                'description' => $pricing['description'] ?? null,
                'price' => $pricing['price'] ?? null,
                'duration' => $pricing['duration'] ?? null,
                'features' => $pricing['features'] ?? [],
                'is_popular' => $pricing['is_popular'] ?? false,
                'order' => $pricing['order'] ?? $index,
            ]);
        }

        $service->projects()->sync($dto->projectIds);
    }

    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                $this->model->where('id', $item['id'])
                    ->update(['order' => $item['order']]);
            }
        });

        Cache::tags(['services'])->flush();
    }

    public function toggleStatus(Service $service): bool
    {
        $service->update([
            'is_published' => !$service->is_published
        ]);

        Cache::tags(['services'])->flush();

        return $service->is_published;
    }

    public function clone(Service $service): Service
    {
        return DB::transaction(function () use ($service) {
            $clone = $service->replicate();
            $clone->title = $service->title . ' (Copy)';
            $clone->slug = $service->slug . '-copy-' . uniqid();
            $clone->is_published = false;
            $clone->save();

            foreach ($service->features as $feature) {
                $clone->features()->create($feature->toArray());
            }

            foreach ($service->processSteps as $step) {
                $clone->processSteps()->create($step->toArray());
            }

            foreach ($service->faqs as $faq) {
                $clone->faqs()->create($faq->toArray());
            }

            foreach ($service->technologies as $tech) {
                $clone->technologies()->create($tech->toArray());
            }

            foreach ($service->pricingModels as $pricing) {
                $clone->pricingModels()->create($pricing->toArray());
            }

            $clone->projects()->sync($service->projects->pluck('id'));

            if ($service->getFirstMedia('featured_image')) {
                $clone->addMedia($service->getFirstMedia('featured_image')->getPath())
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            }

            Cache::tags(['services'])->flush();

            return $clone->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ]);
        });
    }
}

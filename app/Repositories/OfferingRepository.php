<?php

namespace App\Repositories;

use App\Models\Offering;
use App\DTOs\OfferingData;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class OfferingRepository extends BaseRepository
{
    public function __construct(Offering $offering)
    {
        parent::__construct($offering);
    }

    public function paginateWithFilters(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $cacheKey = 'offerings:' . md5(json_encode($filters) . $perPage . request('page', 1));
        
        return Cache::tags(['offerings'])->remember($cacheKey, 3600, function () use ($filters, $perPage) {
            $query = $this->model->select('offerings.*')->withCount([
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
                    $q->where('offerings.title', 'like', "%{$filters['search']}%")
                      ->orWhere('offerings.tagline', 'like', "%{$filters['search']}%")
                      ->orWhere('offerings.overview', 'like', "%{$filters['search']}%");
                });
            }

            if (isset($filters['status']) && $filters['status'] !== '') {
                $query->where('offerings.is_published', $filters['status'] === 'published');
            }

            if (isset($filters['is_highlighted'])) {
                $query->where('offerings.is_highlighted', $filters['is_highlighted']);
            }

            $sortField = $filters['sort_field'] ?? 'order';
            $sortDirection = $filters['sort_direction'] ?? 'asc';

            $query->orderBy('offerings.' . $sortField, $sortDirection);

            return $query->paginate($perPage);
        });
    }

    public function createFromDTO(OfferingData $dto): Offering
    {
        return DB::transaction(function () use ($dto) {
            $offering = $this->model->create($dto->toArray());

            if ($dto->featuredImage) {
                $offering->addMedia($dto->featuredImage)
                    ->toMediaCollection('featured_image');
            }

            $this->syncRelations($offering, $dto);

            Cache::tags(['offerings'])->flush();

            return $offering->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ]);
        });
    }

    public function updateFromDTO(Offering $offering, OfferingData $dto): Offering
    {
        return DB::transaction(function () use ($offering, $dto) {
            $offering->update($dto->toArray());

            if ($dto->featuredImage) {
                $offering->clearMediaCollection('featured_image');
                $offering->addMedia($dto->featuredImage)
                    ->toMediaCollection('featured_image');
            }

            $this->syncRelations($offering, $dto);

            Cache::tags(['offerings'])->flush();

            return $offering->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ]);
        });
    }

    protected function syncRelations(Offering $offering, OfferingData $dto): void
    {
        $offering->features()->delete();
        foreach ($dto->features as $index => $feature) {
            $offering->features()->create([
                'title' => $feature['title'],
                'description' => $feature['description'] ?? null,
                'icon' => $feature['icon'] ?? null,
                'order' => $feature['order'] ?? $index,
            ]);
        }

        $offering->processSteps()->delete();
        foreach ($dto->processSteps as $index => $step) {
            $offering->processSteps()->create([
                'title' => $step['title'],
                'description' => $step['description'] ?? null,
                'icon' => $step['icon'] ?? null,
                'order' => $step['order'] ?? $index,
            ]);
        }

        $offering->faqs()->delete();
        foreach ($dto->faqs as $index => $faq) {
            $offering->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $faq['order'] ?? $index,
            ]);
        }

        $offering->technologies()->delete();
        foreach ($dto->technologies as $index => $tech) {
            $offering->technologies()->create([
                'name' => $tech['name'],
                'icon' => $tech['icon'] ?? null,
                'order' => $tech['order'] ?? $index,
            ]);
        }

        $offering->pricingModels()->delete();
        foreach ($dto->pricingModels as $index => $pricing) {
            $offering->pricingModels()->create([
                'name' => $pricing['name'],
                'description' => $pricing['description'] ?? null,
                'price' => $pricing['price'] ?? null,
                'duration' => $pricing['duration'] ?? null,
                'features' => $pricing['features'] ?? [],
                'is_popular' => $pricing['is_popular'] ?? false,
                'order' => $pricing['order'] ?? $index,
            ]);
        }

        $offering->projects()->sync($dto->projectIds);
    }

    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                $this->model->where('id', $item['id'])
                    ->update(['order' => $item['order']]);
            }
        });

        Cache::tags(['offerings'])->flush();
    }

    public function toggleStatus(Offering $offering): bool
    {
        $offering->update([
            'is_published' => !$offering->is_published
        ]);

        Cache::tags(['offerings'])->flush();

        return $offering->is_published;
    }

    public function clone(Offering $offering): Offering
    {
        return DB::transaction(function () use ($offering) {
            $clone = $offering->replicate();
            $clone->title = $offering->title . ' (Copy)';
            $clone->slug = $offering->slug . '-copy-' . uniqid();
            $clone->is_published = false;
            $clone->save();

            foreach ($offering->features as $feature) {
                $clone->features()->create($feature->toArray());
            }

            foreach ($offering->processSteps as $step) {
                $clone->processSteps()->create($step->toArray());
            }

            foreach ($offering->faqs as $faq) {
                $clone->faqs()->create($faq->toArray());
            }

            foreach ($offering->technologies as $tech) {
                $clone->technologies()->create($tech->toArray());
            }

            foreach ($offering->pricingModels as $pricing) {
                $clone->pricingModels()->create($pricing->toArray());
            }

            $clone->projects()->sync($offering->projects->pluck('id'));

            if ($offering->getFirstMedia('featured_image')) {
                $clone->addMedia($offering->getFirstMedia('featured_image')->getPath())
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            }

            Cache::tags(['offerings'])->flush();

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
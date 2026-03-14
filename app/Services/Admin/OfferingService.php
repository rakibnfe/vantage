<?php

namespace App\Services\Admin;

use App\DTOs\OfferingData;
use App\Models\Offering;
use App\Models\Project;
use App\Repositories\OfferingRepository;
use App\Http\Requests\Admin\OfferingRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OfferingService
{
    public function __construct(
        private readonly OfferingRepository $repository
    ) {}

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->paginateWithFilters($filters);
    }

    public function find(int $id): ?Offering
    {
        return $this->repository->find($id);
    }

    public function create(OfferingRequest $request): Offering
    {
        $dto = OfferingData::fromRequest($request->validated());
        return $this->repository->createFromDTO($dto);
    }

    public function update(Offering $offering, OfferingRequest $request): Offering
    {
        $dto = OfferingData::fromRequest($request->validated());
        return $this->repository->updateFromDTO($offering, $dto);
    }

    public function delete(Offering $offering): bool
    {
        return $this->repository->delete($offering);
    }

    public function reorder(array $items): void
    {
        $this->repository->reorder($items);
    }

    public function toggleStatus(Offering $offering): bool
    {
        return $this->repository->toggleStatus($offering);
    }

    public function clone(Offering $offering): Offering
    {
        return $this->repository->clone($offering);
    }

    public function getProjectsForSelect(): Collection
    {
        return Project::select('id', 'title')
            ->orderBy('title')
            ->get();
    }

    public function getFormData(Offering $offering = null): array
    {
        return [
            'offering' => $offering?->load([
                'features' => fn($q) => $q->orderBy('order'),
                'processSteps' => fn($q) => $q->orderBy('order'),
                'faqs' => fn($q) => $q->orderBy('order'),
                'technologies' => fn($q) => $q->orderBy('order'),
                'pricingModels' => fn($q) => $q->orderBy('order'),
                'projects:id,title'
            ]),
            'projects' => $this->getProjectsForSelect(),
            'selectedProjects' => $offering?->projects->pluck('id')->toArray() ?? [],
        ];
    }
}
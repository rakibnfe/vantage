<?php

namespace App\Services\Admin;

use App\DTOs\ServiceData;
use App\Models\Service;
use App\Models\Project;
use App\Repositories\ServiceRepository;
use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ServiceService
{
    public function __construct(
        private readonly ServiceRepository $repository
    ) {}

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->paginateWithFilters($filters);
    }

    public function find(int $id): ?Service
    {
        return $this->repository->find($id);
    }

    public function create(ServiceRequest $request): Service
    {
        $dto = ServiceData::fromRequest($request->validated());
        return $this->repository->createFromDTO($dto);
    }

    public function update(Service $service, ServiceRequest $request): Service
    {
        $dto = ServiceData::fromRequest($request->validated());
        return $this->repository->updateFromDTO($service, $dto);
    }

    public function delete(Service $service): bool
    {
        return $this->repository->delete($service);
    }

    public function reorder(array $items): void
    {
        $this->repository->reorder($items);
    }

    public function toggleStatus(Service $service): bool
    {
        return $this->repository->toggleStatus($service);
    }

    public function clone(Service $service): Service
    {
        return $this->repository->clone($service);
    }

    public function getProjectsForSelect(): Collection
    {
        return Project::select('id', 'title')
            ->orderBy('title')
            ->get();
    }

    public function getFormData(Service $service = null): array
    {
        return [
            'service' => $service?->load([
                'features' => fn($q) => $q->orderBy('order'),
                'processSteps' => fn($q) => $q->orderBy('order'),
                'faqs' => fn($q) => $q->orderBy('order'),
                'technologies' => fn($q) => $q->orderBy('order'),
                'pricingModels' => fn($q) => $q->orderBy('order'),
                'projects:id,title'
            ]),
            'projects' => $this->getProjectsForSelect(),
            'selectedProjects' => $service?->projects->pluck('id')->toArray() ?? [],
        ];
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Requests\Admin\ServiceReorderRequest;
use App\Models\Service;
use App\Services\Admin\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ServiceController extends BaseController
{
    public function __construct(
        private readonly ServiceService $service
    ) {
        $this->authorizeResource(Service::class, 'service');
    }

    public function index(): View
    {
        $services = $this->service->paginate(request()->only([
            'search', 'status', 'is_featured', 'sort_field', 'sort_direction'
        ]));
        
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $data = $this->service->getFormData();
        return view('admin.services.create', $data);
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $service = $this->service->create($request);
        
        return response()->json([
            'success' => true,
            'message' => 'Service created successfully.',
            'redirect' => route('dashboard.services.edit', $service)
        ]);
    }

    public function show(Service $service): View
    {
        return view('admin.services.show', [
            'service' => $service->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ])
        ]);
    }

    public function edit(Service $service): View
    {
        $data = $this->service->getFormData($service);
        return view('admin.services.edit', $data);
    }

    public function update(ServiceRequest $request, Service $service): JsonResponse
    {
        $this->service->update($service, $request);
        
        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully.',
            'redirect' => route('dashboard.services.edit', $service)
        ]);
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->service->delete($service);
        
        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully.',
            'redirect' => route('dashboard.services.index')
        ]);
    }

    public function reorder(ServiceReorderRequest $request): JsonResponse
    {
        $this->service->reorder($request->items);
        
        return response()->json([
            'success' => true,
            'message' => 'Services reordered successfully.'
        ]);
    }

    public function toggleStatus(Service $service): JsonResponse
    {
        $status = $this->service->toggleStatus($service);
        
        return response()->json([
            'success' => true,
            'message' => $status ? 'Service published.' : 'Service unpublished.',
            'status' => $status
        ]);
    }

    public function clone(Service $service): JsonResponse
    {
        $newService = $this->service->clone($service);
        
        return response()->json([
            'success' => true,
            'message' => 'Service cloned successfully.',
            'redirect' => route('dashboard.services.edit', $newService)
        ]);
    }
}
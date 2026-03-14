<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Requests\Admin\ServiceReorderRequest;
use App\Models\Service;
use App\Services\Admin\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

    public function store(ServiceRequest $request): RedirectResponse
    {
        $service = $this->service->create($request);
        
        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service created successfully.');
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
        $data['activeTab'] = request()->query('tab', 'basic');
        return view('admin.services.edit', $data);
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $this->service->update($service, $request);
        
        // Get the tab from request or default to basic
        $tab = $request->input('active_tab', 'basic');
        
        return redirect()->route('dashboard.services.edit', [$service, 'tab' => $tab])
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->service->delete($service);
        
        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service deleted successfully.');
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

    public function clone(Service $service): RedirectResponse
    {
        $newService = $this->service->clone($service);
        
        return redirect()->route('dashboard.services.edit', $newService)
            ->with('success', 'Service cloned successfully.');
    }
}
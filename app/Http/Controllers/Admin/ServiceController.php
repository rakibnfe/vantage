<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\Admin\ServiceService;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
        // $this->authorizeResource(Service::class, 'service');
    }

    public function index()
    {
        $services = Service::ordered()->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $service = $this->serviceService->create($request->validated());

        return redirect()
            ->route('admin.services.edit', $service)
            ->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $this->serviceService->update($service, $request->validated());

        return redirect()
            ->route('admin.services.edit', $service)
            ->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $this->serviceService->delete($service);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }

    public function toggleStatus(Service $service)
    {
        // $this->authorize('toggleStatus', $service);

        $this->serviceService->toggleStatus($service);

        return back()->with('success', 'Status updated.');
    }

    public function clone(Service $service)
    {
        // $this->authorize('clone', $service);

        $newService = $this->serviceService->clone($service);

        return redirect()
            ->route('admin.services.edit', $newService)
            ->with('success', 'Service cloned.');
    }

    public function reorder(Request $request)
    {
        // $this->authorize('reorder', Service::class);

        $this->serviceService->reorder($request->input('items'));

        return response()->json(['success' => true]);
    }
}
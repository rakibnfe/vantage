<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    /**
     * Display list of all services.
     */
    public function index(): View
    {
        $services = Service::orderBy('order')->get();

        return view('admin.services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(): RedirectResponse
    {
        // TODO: implement store logic
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    /**
     * Update the specified service.
     */
    public function update(Service $service): RedirectResponse
    {
        // TODO: implement update logic
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Delete the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    /**
     * Reorder services.
     */
    public function reorder(): RedirectResponse
    {
        // TODO: implement reorder logic
        return redirect()->route('admin.services.index')->with('success', 'Services reordered successfully.');
    }
}

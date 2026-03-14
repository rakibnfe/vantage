<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\OfferingRequest;
use App\Http\Requests\Admin\OfferingReorderRequest;
use App\Models\Offering;
use App\Services\Admin\OfferingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OfferingController extends BaseController
{
    public function __construct(
        private readonly OfferingService $offering
    ) {
        $this->authorizeResource(Offering::class, 'offering');
    }

    public function index(): View
    {
        $offerings = $this->offering->paginate(request()->only([
            'search', 'status', 'is_highlighted', 'sort_field', 'sort_direction'
        ]));
        
        return view('admin.offerings.index', compact('offerings'));
    }

    public function create(): View
    {
        $data = $this->offering->getFormData();
        return view('admin.offerings.create', $data);
    }

    public function store(OfferingRequest $request): RedirectResponse
    {
        $offering = $this->offering->create($request);
        
        return redirect()->route('dashboard.offerings.index')
            ->with('success', 'Offering created successfully.');
    }

    public function show(Offering $offering): View
    {
        return view('admin.offerings.show', [
            'offering' => $offering->load([
                'features',
                'processSteps',
                'faqs',
                'technologies',
                'pricingModels',
                'projects'
            ])
        ]);
    }

    public function edit(Offering $offering): View
    {
        $data = $this->offering->getFormData($offering);
        $data['activeTab'] = request()->query('tab', 'basic');
        return view('admin.offerings.edit', $data);
    }

    public function update(OfferingRequest $request, Offering $offering): RedirectResponse
    {
        $this->offering->update($offering, $request);
        
        // Get the tab from request or default to basic
        $tab = $request->input('active_tab', 'basic');
        
        return redirect()->route('dashboard.offerings.edit', [$offering, 'tab' => $tab])
            ->with('success', 'Offering updated successfully.');
    }

    public function destroy(Offering $offering): RedirectResponse
    {
        $this->offering->delete($offering);
        
        return redirect()->route('dashboard.offerings.index')
            ->with('success', 'Offering deleted successfully.');
    }

    public function reorder(OfferingReorderRequest $request): JsonResponse
    {
        $this->offering->reorder($request->items);
        
        return response()->json([
            'success' => true,
            'message' => 'Offerings reordered successfully.'
        ]);
    }

    public function toggleStatus(Offering $offering): JsonResponse
    {
        $status = $this->offering->toggleStatus($offering);
        
        return response()->json([
            'success' => true,
            'message' => $status ? 'Offering published.' : 'Offering unpublished.',
            'status' => $status
        ]);
    }

    public function clone(Offering $offering): RedirectResponse
    {
        $newOffering = $this->offering->clone($offering);
        
        return redirect()->route('dashboard.offerings.edit', $newOffering)
            ->with('success', 'Offering cloned successfully.');
    }
}
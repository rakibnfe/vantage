<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessStepResource;
use App\Models\Service;
use App\Models\ServiceProcessStep;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of all process steps.
     */
    public function index(Request $request)
    {
        $query = ServiceProcessStep::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug', 'icon');
            }])
            ->whereHas('service', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by service
        if ($request->has('service_id') && $request->service_id) {
            $query->where('service_id', $request->service_id);
        }

        // Search in titles and descriptions
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $query->orderBy('order');

        // Pagination
        $perPage = $request->get('per_page', 50);
        $steps = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => ProcessStepResource::collection($steps),
            'meta' => [
                'current_page' => $steps->currentPage(),
                'last_page' => $steps->lastPage(),
                'per_page' => $steps->perPage(),
                'total' => $steps->total(),
                'from' => $steps->firstItem(),
                'to' => $steps->lastItem(),
            ],
            'message' => 'Process steps retrieved successfully'
        ]);
    }

    /**
     * Display the specified process step.
     */
    public function show($id)
    {
        $step = ServiceProcessStep::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug', 'icon');
            }])
            ->find($id);

        if (!$step) {
            return response()->json([
                'success' => false,
                'message' => 'Process step not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ProcessStepResource($step),
            'message' => 'Process step retrieved successfully'
        ]);
    }

    /**
     * Get process steps by service slug.
     */
    public function byService($serviceSlug)
    {
        $service = Service::where('slug', $serviceSlug)
            ->where('is_published', true)
            ->first();

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found'
            ], 404);
        }

        $steps = $service->processSteps()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => ProcessStepResource::collection($steps),
            'meta' => [
                'service' => [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'icon' => $service->icon
                ],
                'total' => $steps->count()
            ],
            'message' => 'Service process steps retrieved successfully'
        ]);
    }

    /**
     * Get process steps grouped by service.
     */
    public function grouped()
    {
        $services = Service::with(['processSteps' => function ($q) {
                $q->orderBy('order');
            }])
            ->where('is_published', true)
            ->whereHas('processSteps')
            ->orderBy('order')
            ->get();

        $data = $services->map(function ($service) {
            return [
                'service' => [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'icon' => $service->icon
                ],
                'steps' => ProcessStepResource::collection($service->processSteps)
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'total_services' => $services->count()
            ],
            'message' => 'Grouped process steps retrieved successfully'
        ]);
    }
}
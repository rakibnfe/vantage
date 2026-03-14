<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessStepResource;
use App\Models\Offering;
use App\Models\OfferingProcessStep;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of all process steps.
     */
    public function index(Request $request)
    {
        $query = OfferingProcessStep::with(['offering' => function ($q) {
                $q->select('id', 'title', 'slug', 'icon');
            }])
            ->whereHas('offering', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by offering
        if ($request->has('offering_id') && $request->offering_id) {
            $query->where('offering_id', $request->offering_id);
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
        $step = OfferingProcessStep::with(['offering' => function ($q) {
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
     * Get process steps by offering slug.
     */
    public function byOffering($offeringSlug)
    {
        $offering = Offering::where('slug', $offeringSlug)
            ->where('is_published', true)
            ->first();

        if (!$offering) {
            return response()->json([
                'success' => false,
                'message' => 'Offering not found'
            ], 404);
        }

        $steps = $offering->processSteps()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => ProcessStepResource::collection($steps),
            'meta' => [
                'offering' => [
                    'id' => $offering->id,
                    'title' => $offering->title,
                    'slug' => $offering->slug,
                    'icon' => $offering->icon
                ],
                'total' => $steps->count()
            ],
            'message' => 'Offering process steps retrieved successfully'
        ]);
    }

    /**
     * Get process steps grouped by offering.
     */
    public function grouped()
    {
        $offerings = Offering::with(['processSteps' => function ($q) {
                $q->orderBy('order');
            }])
            ->where('is_published', true)
            ->whereHas('processSteps')
            ->orderBy('order')
            ->get();

        $data = $offerings->map(function ($offering) {
            return [
                'offering' => [
                    'id' => $offering->id,
                    'title' => $offering->title,
                    'slug' => $offering->slug,
                    'icon' => $offering->icon
                ],
                'steps' => ProcessStepResource::collection($offering->processSteps)
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'total_offerings' => $offerings->count()
            ],
            'message' => 'Grouped process steps retrieved successfully'
        ]);
    }
}
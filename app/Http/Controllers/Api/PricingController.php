<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PricingModelResource;
use App\Models\Service;
use App\Models\ServicePricingModel;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of all pricing models.
     */
    public function index(Request $request)
    {
        $query = ServicePricingModel::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('service', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by service
        if ($request->has('service_id') && $request->service_id) {
            $query->where('service_id', $request->service_id);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('starting_price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('starting_price', '<=', $request->max_price);
        }

        // Search in names and descriptions
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('notes', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $query->orderBy('order');

        // Pagination
        $perPage = $request->get('per_page', 20);
        $pricing = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => PricingModelResource::collection($pricing),
            'meta' => [
                'current_page' => $pricing->currentPage(),
                'last_page' => $pricing->lastPage(),
                'per_page' => $pricing->perPage(),
                'total' => $pricing->total(),
                'from' => $pricing->firstItem(),
                'to' => $pricing->lastItem(),
            ],
            'message' => 'Pricing models retrieved successfully'
        ]);
    }

    /**
     * Display the specified pricing model.
     */
    public function show($id)
    {
        $pricing = ServicePricingModel::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->find($id);

        if (!$pricing) {
            return response()->json([
                'success' => false,
                'message' => 'Pricing model not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PricingModelResource($pricing),
            'message' => 'Pricing model retrieved successfully'
        ]);
    }

    /**
     * Get pricing models by service slug.
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

        $pricing = $service->pricingModels()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => PricingModelResource::collection($pricing),
            'meta' => [
                'service' => [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug
                ],
                'total' => $pricing->count()
            ],
            'message' => 'Service pricing models retrieved successfully'
        ]);
    }

    /**
     * Get pricing comparison across all services.
     */
    public function comparison()
    {
        $services = Service::with(['pricingModels' => function ($q) {
                $q->orderBy('order');
            }])
            ->where('is_published', true)
            ->whereHas('pricingModels')
            ->orderBy('order')
            ->get();

        $data = $services->map(function ($service) {
            return [
                'service' => [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'tagline' => $service->tagline,
                ],
                'pricing_models' => PricingModelResource::collection($service->pricingModels)
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'total_services' => $services->count(),
                'total_models' => $services->sum(function ($service) {
                    return $service->pricingModels->count();
                })
            ],
            'message' => 'Pricing comparison retrieved successfully'
        ]);
    }

    /**
     * Get pricing summary (min, max, average).
     */
    public function summary()
    {
        $pricingModels = ServicePricingModel::whereHas('service', function ($q) {
            $q->where('is_published', true);
        })->get();

        $prices = $pricingModels->pluck('starting_price')->filter();

        $summary = [
            'min_price' => $prices->min(),
            'max_price' => $prices->max(),
            'avg_price' => round($prices->avg(), 2),
            'total_models' => $pricingModels->count(),
            'services_with_pricing' => $pricingModels->groupBy('service_id')->count()
        ];

        return response()->json([
            'success' => true,
            'data' => $summary,
            'message' => 'Pricing summary retrieved successfully'
        ]);
    }
}
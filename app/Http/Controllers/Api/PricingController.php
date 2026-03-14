<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PricingModelResource;
use App\Models\Offering;
use App\Models\OfferingPricingModel;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of all pricing models.
     */
    public function index(Request $request)
    {
        $query = OfferingPricingModel::with(['offering' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('offering', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by offering
        if ($request->has('offering_id') && $request->offering_id) {
            $query->where('offering_id', $request->offering_id);
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
        $pricing = OfferingPricingModel::with(['offering' => function ($q) {
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
     * Get pricing models by offering slug.
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

        $pricing = $offering->pricingModels()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => PricingModelResource::collection($pricing),
            'meta' => [
                'offering' => [
                    'id' => $offering->id,
                    'title' => $offering->title,
                    'slug' => $offering->slug
                ],
                'total' => $pricing->count()
            ],
            'message' => 'Offering pricing models retrieved successfully'
        ]);
    }

    /**
     * Get pricing comparison across all offerings.
     */
    public function comparison()
    {
        $offerings = Offering::with(['pricingModels' => function ($q) {
                $q->orderBy('order');
            }])
            ->where('is_published', true)
            ->whereHas('pricingModels')
            ->orderBy('order')
            ->get();

        $data = $offerings->map(function ($offering) {
            return [
                'offering' => [
                    'id' => $offering->id,
                    'title' => $offering->title,
                    'slug' => $offering->slug,
                    'tagline' => $offering->tagline,
                ],
                'pricing_models' => PricingModelResource::collection($offering->pricingModels)
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'total_offerings' => $offerings->count(),
                'total_models' => $offerings->sum(function ($offering) {
                    return $offering->pricingModels->count();
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
        $pricingModels = OfferingPricingModel::whereHas('offering', function ($q) {
            $q->where('is_published', true);
        })->get();

        $prices = $pricingModels->pluck('starting_price')->filter();

        $summary = [
            'min_price' => $prices->min(),
            'max_price' => $prices->max(),
            'avg_price' => round($prices->avg(), 2),
            'total_models' => $pricingModels->count(),
            'offerings_with_pricing' => $pricingModels->groupBy('offering_id')->count()
        ];

        return response()->json([
            'success' => true,
            'data' => $summary,
            'message' => 'Pricing summary retrieved successfully'
        ]);
    }
}
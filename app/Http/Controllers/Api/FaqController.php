<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FAQResource;
use App\Models\Service;
use App\Models\ServiceFAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of all FAQs.
     */
    public function index(Request $request)
    {
        $query = ServiceFAQ::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('service', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by service
        if ($request->has('service_id') && $request->service_id) {
            $query->where('service_id', $request->service_id);
        }

        // Search in questions and answers
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'LIKE', "%{$search}%")
                  ->orWhere('answer', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $query->orderBy('order');

        // Pagination
        $perPage = $request->get('per_page', 20);
        $faqs = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => FAQResource::collection($faqs),
            'meta' => [
                'current_page' => $faqs->currentPage(),
                'last_page' => $faqs->lastPage(),
                'per_page' => $faqs->perPage(),
                'total' => $faqs->total(),
                'from' => $faqs->firstItem(),
                'to' => $faqs->lastItem(),
            ],
            'message' => 'FAQs retrieved successfully'
        ]);
    }

    /**
     * Display the specified FAQ.
     */
    public function show($id)
    {
        $faq = ServiceFAQ::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->find($id);

        if (!$faq) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new FAQResource($faq),
            'message' => 'FAQ retrieved successfully'
        ]);
    }

    /**
     * Get FAQs by service slug.
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

        $faqs = $service->faqs()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => FAQResource::collection($faqs),
            'meta' => [
                'service' => [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug
                ],
                'total' => $faqs->count()
            ],
            'message' => 'Service FAQs retrieved successfully'
        ]);
    }

    /**
     * Get featured FAQs (most common questions).
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 6);

        $faqs = ServiceFAQ::with(['service' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('service', function ($q) {
                $q->where('is_published', true);
            })
            ->orderBy('order')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => FAQResource::collection($faqs),
            'meta' => [
                'total' => $faqs->count()
            ],
            'message' => 'Featured FAQs retrieved successfully'
        ]);
    }
}
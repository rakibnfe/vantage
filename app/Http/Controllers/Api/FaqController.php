<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FAQResource;
use App\Models\Offering;
use App\Models\OfferingFAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of all FAQs.
     */
    public function index(Request $request)
    {
        $query = OfferingFAQ::with(['offering' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('offering', function ($q) {
                $q->where('is_published', true);
            });

        // Filter by offering
        if ($request->has('offering_id') && $request->offering_id) {
            $query->where('offering_id', $request->offering_id);
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
        $faq = OfferingFAQ::with(['offering' => function ($q) {
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
     * Get FAQs by offering slug.
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

        $faqs = $offering->faqs()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => FAQResource::collection($faqs),
            'meta' => [
                'offering' => [
                    'id' => $offering->id,
                    'title' => $offering->title,
                    'slug' => $offering->slug
                ],
                'total' => $faqs->count()
            ],
            'message' => 'Offering FAQs retrieved successfully'
        ]);
    }

    /**
     * Get featured FAQs (most common questions).
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 6);

        $faqs = OfferingFAQ::with(['offering' => function ($q) {
                $q->select('id', 'title', 'slug');
            }])
            ->whereHas('offering', function ($q) {
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
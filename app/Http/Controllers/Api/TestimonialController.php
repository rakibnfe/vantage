<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Http\Resources\TestimonialCollection;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $testimonials = Testimonial::query()
            ->published()
            ->when($request->has('featured'), function ($query) use ($request) {
                return $query->where('is_featured', $request->boolean('featured'));
            })
            ->when($request->has('min_rating'), function ($query) use ($request) {
                return $query->where('rating', '>=', $request->min_rating);
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->search;
                return $query->where(function ($q) use ($search) {
                    $q->where('client_name', 'LIKE', "%{$search}%")
                      ->orWhere('client_company', 'LIKE', "%{$search}%")
                      ->orWhere('content', 'LIKE', "%{$search}%")
                      ->orWhere('project_name', 'LIKE', "%{$search}%");
                });
            })
            ->ordered()
            ->paginate($perPage);

        return new TestimonialCollection($testimonials);
    }

    public function show(Testimonial $testimonial)
    {
        if (!$testimonial->is_published) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        return response()->json([
            'data' => new TestimonialResource($testimonial),
            'message' => 'Testimonial retrieved successfully'
        ]);
    }

    public function featured()
    {
        $testimonials = Testimonial::published()
            ->featured()
            ->ordered()
            ->take(6)
            ->get();

        return response()->json([
            'data' => TestimonialResource::collection($testimonials),
            'meta' => ['total' => $testimonials->count()]
        ]);
    }
}
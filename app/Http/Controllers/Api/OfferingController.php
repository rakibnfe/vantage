<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferingResource;
use App\Http\Resources\OfferingCollection;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TechnologyResource;
use App\Http\Resources\FAQResource;
use App\Http\Resources\ProcessStepResource;
use App\Http\Resources\PricingModelResource;
use App\Models\Offering;
use Illuminate\Http\Request;

class OfferingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        
        $offerings = Offering::query()
            ->with(['features', 'processSteps', 'faqs', 'technologies', 'pricingModels'])
            ->when($request->has('highlighted'), function ($query) use ($request) {
                return $query->where('is_highlighted', $request->boolean('highlighted'));
            })
            ->when($request->has('published'), function ($query) use ($request) {
                return $query->where('is_published', $request->boolean('published'));
            })
            ->orderBy('order')
            ->orderBy('title')
            ->paginate($perPage);
        
        return new OfferingCollection($offerings);
    }

    public function show($slug)
    {
        $offering = Offering::where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'features' => fn($q) => $q->orderBy('order'),
                'processSteps' => fn($q) => $q->orderBy('order'),
                'faqs' => fn($q) => $q->orderBy('order'),
                'technologies' => fn($q) => $q->orderBy('order'),
                'pricingModels' => fn($q) => $q->orderBy('order'),
                'projects' => fn($q) => $q->published()->highlighted()->take(3),
                'tags',
            ])
            ->first();
        
        if (!$offering) {
            return response()->json(['message' => 'Offering not found'], 404);
        }
        
        return response()->json([
            'data' => new OfferingResource($offering),
            'message' => 'Offering retrieved successfully'
        ]);
    }

    public function projects(Request $request, Offering $offering)
    {
        $limit = $request->get('limit', 6);
        
        $projects = $offering->projects()
            ->with(['tags'])
            ->published()
            ->orderBy('is_highlighted', 'desc')
            ->orderBy('order')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'data' => ProjectResource::collection($projects),
            'meta' => ['count' => $projects->count()]
        ]);
    }

    public function technologies(Offering $offering)
    {
        $technologies = $offering->technologies()
            ->orderBy('order')
            ->get();
        
        $grouped = $technologies->groupBy('category')->map(function ($items, $category) {
            return [
                'category' => $category,
                'items' => TechnologyResource::collection($items)
            ];
        })->values();
        
        return response()->json([
            'data' => TechnologyResource::collection($technologies),
            'grouped' => $grouped
        ]);
    }

    public function faqs(Offering $offering)
    {
        $faqs = $offering->faqs()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => FAQResource::collection($faqs)
        ]);
    }

    public function processSteps(Offering $offering)
    {
        $steps = $offering->processSteps()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => ProcessStepResource::collection($steps)
        ]);
    }

    public function pricing(Offering $offering)
    {
        $pricing = $offering->pricingModels()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => PricingModelResource::collection($pricing)
        ]);
    }
}
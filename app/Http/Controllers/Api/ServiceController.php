<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TechnologyResource;
use App\Http\Resources\FAQResource;
use App\Http\Resources\ProcessStepResource;
use App\Http\Resources\PricingModelResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        
        $services = Service::query()
            ->with(['features', 'processSteps', 'faqs', 'technologies', 'pricingModels'])
            ->when($request->has('featured'), function ($query) use ($request) {
                return $query->where('is_featured', $request->boolean('featured'));
            })
            ->when($request->has('published'), function ($query) use ($request) {
                return $query->where('is_published', $request->boolean('published'));
            })
            ->orderBy('order')
            ->orderBy('title')
            ->paginate($perPage);
        
        return new ServiceCollection($services);
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'features' => fn($q) => $q->orderBy('order'),
                'processSteps' => fn($q) => $q->orderBy('order'),
                'faqs' => fn($q) => $q->orderBy('order'),
                'technologies' => fn($q) => $q->orderBy('order'),
                'pricingModels' => fn($q) => $q->orderBy('order'),
                'projects' => fn($q) => $q->published()->featured()->take(3),
                'tags',
            ])
            ->first();
        
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        
        return response()->json([
            'data' => new ServiceResource($service),
            'message' => 'Service retrieved successfully'
        ]);
    }

    public function projects(Request $request, Service $service)
    {
        $limit = $request->get('limit', 6);
        
        $projects = $service->projects()
            ->with(['tags'])
            ->published()
            ->orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'data' => ProjectResource::collection($projects),
            'meta' => ['count' => $projects->count()]
        ]);
    }

    public function technologies(Service $service)
    {
        $technologies = $service->technologies()
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

    public function faqs(Service $service)
    {
        $faqs = $service->faqs()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => FAQResource::collection($faqs)
        ]);
    }

    public function processSteps(Service $service)
    {
        $steps = $service->processSteps()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => ProcessStepResource::collection($steps)
        ]);
    }

    public function pricing(Service $service)
    {
        $pricing = $service->pricingModels()
            ->orderBy('order')
            ->get();
        
        return response()->json([
            'data' => PricingModelResource::collection($pricing)
        ]);
    }
}
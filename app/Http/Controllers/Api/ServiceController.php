<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\TechnologyResource;
use App\Http\Resources\FAQResource;
use App\Http\Resources\ProcessStepResource;
use App\Http\Resources\PricingModelResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
   public function index(Request $request)
{
    $perPage = $request->get('per_page', 10);
    
    // If per_page is 'all' or very large, get all records
    if ($perPage === 'all' || $perPage > 100) {
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
            ->get();
        
        return response()->json([
            'data' => ServiceResource::collection($services),
            'meta' => [
                'total' => $services->count(),
                'per_page' => 'all'
            ]
        ]);
    }
    
    // Normal paginated response
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

    public function featured()
    {
        $services = Cache::remember('services.featured', 3600, function () {
            return Service::with(['features', 'processSteps'])
                ->where('is_published', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(6)
                ->get();
        });
        
        return response()->json([
            'data' => ServiceResource::collection($services),
            'meta' => [
                'total' => $services->count(),
                'featured_count' => $services->count(),
            ]
        ]);
    }

    public function show(Service $service)
    {
        if (!$service->is_published) {
            abort(404);
        }
        
        $service->load([
            'features' => fn($q) => $q->orderBy('order'),
            'processSteps' => fn($q) => $q->orderBy('order'),
            'faqs' => fn($q) => $q->orderBy('order'),
            'technologies' => fn($q) => $q->orderBy('order'),
            'pricingModels' => fn($q) => $q->orderBy('order'),
            'projects' => fn($q) => $q->published()->featured()->take(3),
            'tags',
        ]);
        
        return new ServiceResource($service);
    }

    public function projects(Service $service, Request $request)
    {
        $limit = $request->get('limit', 6);
        
        $projects = $service->projects()
            ->with(['tags'])
            ->published()
            ->orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->limit($limit)
            ->get();
        
        return new ProjectCollection($projects);
    }

    public function technologies(Service $service)
    {
        $technologies = $service->technologies()
            ->orderBy('order')
            ->get()
            ->groupBy('category');
        
        return response()->json([
            'data' => TechnologyResource::collection($service->technologies),
            'grouped' => $technologies->map(function ($items, $category) {
                return [
                    'category' => $category,
                    'items' => TechnologyResource::collection($items)
                ];
            })->values()
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

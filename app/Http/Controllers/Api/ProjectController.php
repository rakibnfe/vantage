<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
  
public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        $projects = Project::query()
            ->with(['tags', 'services'])
            ->published()
            ->when($request->has('featured'), function ($query) use ($request) {
                return $query->where('is_featured', $request->boolean('featured'));
            })
            ->when($request->has('status'), function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return response()->json([
            'data' => $projects->items(),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
                'from' => $projects->firstItem(),
                'to' => $projects->lastItem(),
            ],
            'links' => [
                'first' => $projects->url(1),
                'last' => $projects->url($projects->lastPage()),
                'prev' => $projects->previousPageUrl(),
                'next' => $projects->nextPageUrl(),
            ]
        ]);
    }

   public function show($slug)
{
    $project = Project::where('slug', $slug)
        ->where('is_published', true)
        ->with(['tags', 'services', 'user'])
        ->first();
    
    if (!$project) {
        return response()->json([
            'message' => 'Project not found'
        ], 404);
    }
    
    // Calculate duration if start and end dates exist
    if ($project->start_date && $project->end_date) {
        $project->duration_days = $project->end_date->diffInDays($project->start_date);
    }
    
    return response()->json([
        'data' => $project,
        'message' => 'Project retrieved successfully'
    ]);
}

// Add this method to get projects by slug with different parameter name
public function findBySlug($slug)
{
    return $this->show($slug);
}

    public function featured()
    {
        $projects = Project::published()
            ->where('is_featured', true)
            ->with(['tags', 'services'])
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        return response()->json([
            'data' => $projects,
            'meta' => [
                'total' => $projects->count()
            ]
        ]);
    }

    public function byStatus($status, Request $request)
    {
        $validStatuses = ['planning', 'in_progress', 'completed'];
        
        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }
        
        $perPage = $request->get('per_page', 12);
        
        $projects = Project::published()
            ->where('status', $status)
            ->with(['tags', 'services'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return response()->json([
            'data' => $projects->items(),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total()
            ]
        ]);
    }

    public function byTag(Tag $tag, Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        $projects = $tag->projects()
            ->published()
            ->with(['tags', 'services'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return new ProjectCollection($projects);
    }

    public function related(Project $project, Request $request)
    {
        $limit = $request->get('limit', 4);
        
        $tagIds = $project->tags->pluck('id');
        $serviceIds = $project->services->pluck('id');
        
        $related = Project::published()
            ->where('id', '!=', $project->id)
            ->where(function ($query) use ($tagIds, $serviceIds) {
                $query->whereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                })->orWhereHas('services', function ($q) use ($serviceIds) {
                    $q->whereIn('services.id', $serviceIds);
                });
            })
            ->with(['tags', 'services'])
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'data' => ProjectResource::collection($related),
            'meta' => [
                'count' => $related->count(),
                'based_on' => 'tags_and_services'
            ]
        ]);
    }

    public function technologies(Project $project)
    {
        $technologies = $project->technologies ?? [];
        
        return response()->json([
            'data' => $technologies,
            'count' => count($technologies)
        ]);
    }
}

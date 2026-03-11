<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use Illuminate\Http\Request;

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
            ->when($request->has('tag'), function ($query) use ($request) {
                return $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('slug', $request->tag);
                });
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return new ProjectCollection($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->with(['tags', 'services', 'user'])
            ->first();
        
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        
        return response()->json([
            'data' => new ProjectResource($project),
            'message' => 'Project retrieved successfully'
        ]);
    }

    public function related(Request $request, Project $project)
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
            'meta' => ['count' => $related->count()]
        ]);
    }

    public function technologies(Project $project)
    {
        $technologies = $project->technologies ?? [];
        
        return response()->json([
            'data' => $technologies,
            'meta' => ['count' => count($technologies)]
        ]);
    }
}
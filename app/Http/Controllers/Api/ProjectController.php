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
            ->with(['tags', 'offerings'])
            ->published()
            ->when($request->has('featured'), function ($query) use ($request) {
                return $query->where('is_highlighted', $request->boolean('featured'));
            })
            ->when($request->has('status'), function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->has('tag'), function ($query) use ($request) {
                return $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('slug', $request->tag);
                });
            })
            ->orderBy('is_highlighted', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return new ProjectCollection($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->with(['tags', 'offerings', 'user'])
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
        $offeringIds = $project->offerings->pluck('id');
        
        $related = Project::published()
            ->where('id', '!=', $project->id)
            ->where(function ($query) use ($tagIds, $offeringIds) {
                $query->whereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                })->orWhereHas('offerings', function ($q) use ($offeringIds) {
                    $q->whereIn('offerings.id', $offeringIds);
                });
            })
            ->with(['tags', 'offerings'])
            ->orderBy('is_highlighted', 'desc')
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
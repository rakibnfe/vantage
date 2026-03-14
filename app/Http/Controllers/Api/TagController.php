<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        
        $tags = Tag::withCount(['projects', 'articles', 'offerings'])
            ->orderBy('name')
            ->paginate($perPage);
        
        return new TagCollection($tags);
    }

    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)
            ->withCount(['projects', 'articles', 'offerings'])
            ->first();
        
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        
        return response()->json([
            'data' => new TagResource($tag),
            'message' => 'Tag retrieved successfully'
        ]);
    }
}
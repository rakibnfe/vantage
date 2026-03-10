<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::withCount(['projects', 'articles', 'services'])
            ->orderBy('name')
            ->get();
        
        return response()->json([
            'data' => TagResource::collection($tags),
            'meta' => [
                'total' => $tags->count(),
            ]
        ]);
    }

    public function show(Tag $tag)
    {
        $tag->loadCount(['projects', 'articles', 'services']);
        
        return new TagResource($tag);
    }
}

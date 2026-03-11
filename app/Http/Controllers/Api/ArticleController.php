<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $articles = Article::query()
            ->with(['user', 'category', 'tags'])
            ->published()
            ->when($request->has('category'), function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            })
            ->when($request->has('tag'), function ($query) use ($request) {
                return $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('slug', $request->tag);
                });
            })
            ->when($request->has('author'), function ($query) use ($request) {
                return $query->whereHas('user', function ($q) use ($request) {
                    $q->where('id', $request->author);
                });
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->search;
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('content', 'LIKE', "%{$search}%")
                      ->orWhere('excerpt', 'LIKE', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->paginate($perPage);

        return new ArticleCollection($articles);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->with(['user', 'category', 'tags'])
            ->first();

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json([
            'data' => new ArticleResource($article),
            'message' => 'Article retrieved successfully'
        ]);
    }

    public function related(Request $request, Article $article)
    {
        $limit = $request->get('limit', 4);

        $tagIds = $article->tags->pluck('id');

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->where(function ($query) use ($tagIds) {
                $query->whereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                });
            })
            ->with(['user', 'category', 'tags'])
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'data' => ArticleResource::collection($related),
            'meta' => ['count' => $related->count()]
        ]);
    }
}
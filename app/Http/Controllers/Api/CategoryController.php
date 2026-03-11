<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        
        $categories = Category::withCount('articles')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate($perPage);
        
        return new CategoryCollection($categories);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->withCount('articles')
            ->first();
        
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        
        return response()->json([
            'data' => new CategoryResource($category),
            'message' => 'Category retrieved successfully'
        ]);
    }
}
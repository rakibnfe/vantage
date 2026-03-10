<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    /**
     * Display list of all blog posts.
     */
    public function index(): View
    {
        $posts = Blog::all();

        return view('admin.blog.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created post.
     */
    public function store(): RedirectResponse
    {
        // TODO: implement store logic
        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Blog $blog): View
    {
        return view('admin.blog.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified post.
     */
    public function update(Blog $blog): RedirectResponse
    {
        // TODO: implement update logic
        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Delete the specified post.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }
}

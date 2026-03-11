<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display list of all articles.
     */
    public function index(): View
    {
        $articles = Article::all();

        return view('admin.notes.index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(): View
    {
        return view('admin.notes.create');
    }

    /**
     * Store a newly created article.
     */
    public function store(): RedirectResponse
    {
        // TODO: implement store logic
        return redirect()->route('admin.notes.index')->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article): View
    {
        return view('admin.notes.edit', ['article' => $article]);
    }

    /**
     * Update the specified article.
     */
    public function update(Article $article): RedirectResponse
    {
        // TODO: implement update logic
        return redirect()->route('admin.notes.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Delete the specified article.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.notes.index')->with('success', 'Article deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ToolController extends Controller
{
    /**
     * Display list of all tools.
     */
    public function index(): View
    {
        $tools = Tool::all();

        return view('admin.tools.index', [
            'tools' => $tools,
        ]);
    }

    /**
     * Show the form for creating a new tool.
     */
    public function create(): View
    {
        return view('admin.tools.create');
    }

    /**
     * Store a newly created tool.
     */
    public function store(): RedirectResponse
    {
        // TODO: implement store logic
        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    /**
     * Show the form for editing the specified tool.
     */
    public function edit(Tool $tool): View
    {
        return view('admin.tools.edit', ['tool' => $tool]);
    }

    /**
     * Update the specified tool.
     */
    public function update(Tool $tool): RedirectResponse
    {
        // TODO: implement update logic
        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    /**
     * Delete the specified tool.
     */
    public function destroy(Tool $tool): RedirectResponse
    {
        $tool->delete();

        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * Display list of all projects.
     */
    public function index(): View
    {
        $projects = Project::all();

        return view('admin.work.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.work.create');
    }

    /**
     * Store a newly created project.
     */
    public function store(): RedirectResponse
    {
        // TODO: implement store logic
        return redirect()->route('admin.work.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        return view('admin.work.edit', ['project' => $project]);
    }

    /**
     * Update the specified project.
     */
    public function update(Project $project): RedirectResponse
    {
        // TODO: implement update logic
        return redirect()->route('admin.work.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Delete the specified project.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.work.index')->with('success', 'Project deleted successfully.');
    }
}

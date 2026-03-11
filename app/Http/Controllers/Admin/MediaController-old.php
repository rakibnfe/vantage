<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    /**
     * Display the media library.
     */
    public function index(): View
    {
        return view('admin.media.index');
    }

    /**
     * Upload media files.
     */
    public function upload(): RedirectResponse
    {
        // TODO: implement file upload logic
        return redirect()->route('admin.media.index')->with('success', 'Files uploaded successfully.');
    }

    /**
     * Delete media file.
     */
    public function destroy(): RedirectResponse
    {
        // TODO: implement file deletion logic
        return redirect()->route('admin.media.index')->with('success', 'File deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Store a new contact inquiry.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'budget_range' => 'nullable|string',
            'timeline' => 'nullable|string',
        ]);

        Contact::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been received. We will get back to you soon.',
        ]);
    }
}

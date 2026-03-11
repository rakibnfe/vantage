<?php
// app/Http/Controllers/Api/ContactController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * PUBLIC SITE - Contact form submit করার জন্য শুধু এই method দরকার
     */
    public function store(Request $request)
    {
        // Step 1: Data validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'budget' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'source_page' => 'nullable|string|max:255',
        ]);

        // যদি validation fail করে, error return করো
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Step 2: Visitor খুঁজে বের করো বা নতুন create করো
        try {
            $visitorId = $this->getOrCreateVisitor($request);
        } catch (\Exception $e) {
            // Visitor tracking fail করলেও contact save করা বন্ধ করো না
            $visitorId = null;
        }

        // Step 3: Database এ contact save করো
        $contact = Contact::create([
            'visitor_id' => $visitorId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'budget' => $request->budget,
            'timeline' => $request->timeline,
            'source_page' => $request->source_page ?? url()->previous(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new', // Default status
        ]);

        // Step 4: Success response পাঠাও
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'subject' => $contact->subject,
                'created_at' => $contact->created_at,
            ],
            'message' => 'Thank you for contacting us. We will get back to you soon!'
        ], 201);
    }

    /**
     * Helper method - Visitor track করার জন্য
     */
    private function getOrCreateVisitor(Request $request)
    {
        // Session ID খুঁজে বের করো (frontend থেকে পাঠানো)
        $sessionId = $request->header('X-Session-ID') ?? Str::uuid()->toString();
        
        // Visitor খুঁজে বের করো বা create করো
        $visitor = Visitor::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'browser' => $this->parseBrowser($request->userAgent()),
                'os' => $this->parseOS($request->userAgent()),
                'device' => $this->parseDevice($request->userAgent()),
                'first_visit_at' => now(),
                'last_visit_at' => now(),
                'visit_count' => 1,
                'page_view_count' => 1,
            ]
        );

        // যদি পুরনো visitor হয়, visit count বাড়াও
        if (!$visitor->wasRecentlyCreated) {
            $visitor->increment('visit_count');
            $visitor->update(['last_visit_at' => now()]);
        }

        return $visitor->id;
    }

    /**
     * Helper methods - Browser/OS/Device parse করার জন্য
     */
    private function parseBrowser($userAgent)
    {
        if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        if (strpos($userAgent, 'Safari') !== false) return 'Safari';
        if (strpos($userAgent, 'Edge') !== false) return 'Edge';
        return 'Unknown';
    }

    private function parseOS($userAgent)
    {
        if (strpos($userAgent, 'Windows') !== false) return 'Windows';
        if (strpos($userAgent, 'Mac') !== false) return 'macOS';
        if (strpos($userAgent, 'Linux') !== false) return 'Linux';
        if (strpos($userAgent, 'Android') !== false) return 'Android';
        if (strpos($userAgent, 'iOS') !== false) return 'iOS';
        return 'Unknown';
    }

    private function parseDevice($userAgent)
    {
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|mobile)))/i', $userAgent)) {
            return 'tablet';
        }
        if (preg_match('/(mobile|iphone|ipod|android|blackberry)/i', $userAgent)) {
            return 'mobile';
        }
        return 'desktop';
    }
}
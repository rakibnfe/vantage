<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    /**
     * Display list of all inquiries.
     */
    public function index(): View
    {
        $inquiries = Contact::latest()->paginate(20);

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
        ]);
    }

    /**
     * Show the specified inquiry.
     */
    public function show(Contact $inquiry): View
    {
        return view('admin.inquiries.show', ['inquiry' => $inquiry]);
    }

    /**
     * Update the inquiry status.
     */
    public function updateStatus(Contact $inquiry): RedirectResponse
    {
        // TODO: implement update status logic
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry status updated.');
    }

    /**
     * Send a reply to the inquiry.
     */
    public function reply(Contact $inquiry): RedirectResponse
    {
        // TODO: implement reply logic
        return redirect()->route('admin.inquiries.show', $inquiry)->with('success', 'Reply sent successfully.');
    }

    /**
     * Delete the specified inquiry.
     */
    public function destroy(Contact $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}

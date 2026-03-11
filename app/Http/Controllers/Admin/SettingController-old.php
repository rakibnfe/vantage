<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index(): View
    {
        $settings = [
            'site_name' => env('APP_NAME'),
            'site_description' => '',
            'site_email' => env('MAIL_FROM_ADDRESS'),
            'meta_title' => '',
            'meta_description' => '',
            'smtp_host' => env('MAIL_HOST'),
            'smtp_port' => env('MAIL_PORT'),
        ];

        return view('admin.settings.index', ['settings' => $settings]);
    }

    /**
     * Update settings.
     */
    public function update(): RedirectResponse
    {
        // TODO: implement settings update logic
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}

<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class AdminMenuHelper
{
    public static function getMenuItems()
    {
        return [
            'dashboard' => [
                'route' => 'admin.dashboard',
                'label' => 'Dashboard',
                'icon' => 'home',
                'pattern' => 'admin.dashboard'
            ],
            'content' => [
                'type' => 'section',
                'label' => 'Content'
            ],
            'services' => [
                'route' => 'admin.services.index',
                'label' => 'Services',
                'icon' => 'briefcase',
                'pattern' => 'admin.services.*',
                'pending' => \App\Models\Service::where('is_published', false)->count()
            ],
            'projects' => [
                'route' => 'admin.projects.index',
                'label' => 'Projects',
                'icon' => 'folder',
                'pattern' => 'admin.projects.*',
                'pending' => \App\Models\Project::where('is_published', false)->count()
            ],
            'articles' => [
                'route' => 'admin.articles.index',
                'label' => 'Articles',
                'icon' => 'document-text',
                'pattern' => 'admin.articles.*',
                'pending' => \App\Models\Article::where('is_published', false)->count()
            ],
            'testimonials' => [
                'route' => 'admin.testimonials.index',
                'label' => 'Testimonials',
                'icon' => 'chat-bubble-left-right',
                'pattern' => 'admin.testimonials.*'
            ],
            'appointments' => [
                'type' => 'section',
                'label' => 'Appointments'
            ],
            'calendar' => [
                'route' => 'admin.calendar',
                'label' => 'Calendar',
                'icon' => 'calendar',
                'pattern' => 'admin.calendar',
                'pending' => \App\Models\Schedule::where('status', 'pending')->count(),
                'pending_color' => 'red'
            ],
            'all-bookings' => [
                'route' => 'admin.bookings.index',
                'label' => 'All Bookings',
                'icon' => 'clipboard-document-list',
                'pattern' => 'admin.bookings.*'
            ],
            'set-availability' => [
                'route' => 'admin.availability',
                'label' => 'Set Availability',
                'icon' => 'clock',
                'pattern' => 'admin.availability'
            ],
            'communication' => [
                'type' => 'section',
                'label' => 'Communication'
            ],
            'inquiries' => [
                'route' => 'admin.contacts.index',
                'label' => 'Inquiries',
                'icon' => 'envelope',
                'pattern' => 'admin.contacts.*',
                'pending' => \App\Models\Contact::where('status', 'new')->count(),
                'pending_color' => 'green'
            ],
            'analytics' => [
                'type' => 'section',
                'label' => 'Analytics'
            ],
            'insights' => [
                'route' => 'admin.insights.index',
                'label' => 'Insights',
                'icon' => 'chart-bar',
                'pattern' => 'admin.insights.*'
            ],
            'tools' => [
                'route' => 'admin.tools.index',
                'label' => 'Tools',
                'icon' => 'wrench-screwdriver',
                'pattern' => 'admin.tools.*'
            ],
            'system' => [
                'type' => 'section',
                'label' => 'System'
            ],
            'media' => [
                'route' => 'admin.media.index',
                'label' => 'Media Library',
                'icon' => 'photo',
                'pattern' => 'admin.media.*'
            ],
            'users' => [
                'route' => 'admin.users.index',
                'label' => 'Users',
                'icon' => 'users',
                'pattern' => 'admin.users.*'
            ],
            'settings' => [
                'route' => 'admin.settings.index',
                'label' => 'Settings',
                'icon' => 'cog-6-tooth',
                'pattern' => 'admin.settings.*'
            ]
        ];
    }

    public static function isActive($pattern)
    {
        return Request::routeIs($pattern);
    }

    public static function getIconComponent($icon)
    {
        return "heroicon-o-{$icon}";
    }
}
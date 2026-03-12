<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class AdminMenuHelper
{
    public static function getMenuItems()
    {
        return [
            'dashboard' => [
                'route' => 'dashboard.index',
                'label' => 'Dashboard',
                'icon' => 'home',
                'pattern' => 'dashboard.index'
            ],
            'content' => [
                'type' => 'section',
                'label' => 'Content'
            ],
            'services' => [
                'route' => 'dashboard.services.index',
                'label' => 'Services',
                'icon' => 'briefcase',
                'pattern' => 'dashboard.services.*',
                'pending' => \App\Models\Service::where('is_published', false)->count()
            ],
            'projects' => [
                'route' => 'dashboard.projects.index',
                'label' => 'Projects',
                'icon' => 'folder',
                'pattern' => 'dashboard.projects.*',
                'pending' => \App\Models\Project::where('is_published', false)->count()
            ],
            'articles' => [
                'route' => 'dashboard.articles.index',
                'label' => 'Articles',
                'icon' => 'document-text',
                'pattern' => 'dashboard.articles.*',
                'pending' => \App\Models\Article::where('is_published', false)->count()
            ],
            'testimonials' => [
                'route' => 'dashboard.testimonials.index',
                'label' => 'Testimonials',
                'icon' => 'chat-bubble-left-right',
                'pattern' => 'dashboard.testimonials.*'
            ],
            'appointments' => [
                'type' => 'section',
                'label' => 'Appointments'
            ],
            'calendar' => [
                'route' => 'dashboard.calendar',
                'label' => 'Calendar',
                'icon' => 'calendar',
                'pattern' => 'dashboard.calendar',
                'pending' => \App\Models\Schedule::where('status', 'pending')->count(),
                'pending_color' => 'red'
            ],
            'all-bookings' => [
                'route' => 'dashboard.bookings.index',
                'label' => 'All Bookings',
                'icon' => 'clipboard-document-list',
                'pattern' => 'dashboard.bookings.*'
            ],
            'set-availability' => [
                'route' => 'dashboard.availability',
                'label' => 'Set Availability',
                'icon' => 'clock',
                'pattern' => 'dashboard.availability'
            ],
            'communication' => [
                'type' => 'section',
                'label' => 'Communication'
            ],
            'inquiries' => [
                'route' => 'dashboard.contacts.index',
                'label' => 'Inquiries',
                'icon' => 'envelope',
                'pattern' => 'dashboard.contacts.*',
                'pending' => \App\Models\Contact::where('status', 'new')->count(),
                'pending_color' => 'green'
            ],
            'analytics' => [
                'type' => 'section',
                'label' => 'Analytics'
            ],
            'insights' => [
                'route' => 'dashboard.insights.index',
                'label' => 'Insights',
                'icon' => 'chart-bar',
                'pattern' => 'dashboard.insights.*'
            ],
            'tools' => [
                'route' => 'dashboard.tools.index',
                'label' => 'Tools',
                'icon' => 'wrench-screwdriver',
                'pattern' => 'dashboard.tools.*'
            ],
            'system' => [
                'type' => 'section',
                'label' => 'System'
            ],
            'media' => [
                'route' => 'dashboard.media.index',
                'label' => 'Media Library',
                'icon' => 'photo',
                'pattern' => 'dashboard.media.*'
            ],
            'users' => [
                'route' => 'dashboard.users.index',
                'label' => 'Users',
                'icon' => 'users',
                'pattern' => 'dashboard.users.*'
            ],
            'settings' => [
                'route' => 'dashboard.settings.index',
                'label' => 'Settings',
                'icon' => 'cog-6-tooth',
                'pattern' => 'dashboard.settings.*'
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Schedule;
use App\Models\Visitor;
use App\Models\ToolUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_services' => Service::count(),
            'published_services' => Service::where('is_published', true)->count(),
            'total_projects' => Project::count(),
            'published_projects' => Project::where('is_published', true)->count(),
            'total_articles' => Article::count(),
            'published_articles' => Article::where('is_published', true)->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'new')->count(),
            'total_bookings' => Schedule::where('type', 'appointment')->count(),
            'pending_bookings' => Schedule::where('type', 'appointment')->where('status', 'pending')->count(),
            'today_visitors' => Visitor::whereDate('last_visit_at', today())->count(),
            'total_visitors' => Visitor::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $upcomingBookings = Schedule::where('type', 'appointment')
            ->where('start_time', '>=', now())
            ->where('status', 'approved')
            ->orderBy('start_time')
            ->take(5)
            ->get();
        
        $popularServices = Service::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->take(5)
            ->get();

        $chartData = $this->getChartData();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentContacts',
            'upcomingBookings',
            'popularServices',
            'chartData'
        ));
    }

    public function stats()
    {
        $stats = [
            'visitors' => [
                'today' => Visitor::whereDate('last_visit_at', today())->count(),
                'week' => Visitor::where('last_visit_at', '>=', now()->subDays(7))->count(),
                'month' => Visitor::where('last_visit_at', '>=', now()->subDays(30))->count(),
                'total' => Visitor::count(),
            ],
            'contacts' => [
                'new' => Contact::where('status', 'new')->count(),
                'replied' => Contact::where('status', 'replied')->count(),
                'total' => Contact::count(),
            ],
            'bookings' => [
                'pending' => Schedule::where('type', 'appointment')->where('status', 'pending')->count(),
                'approved' => Schedule::where('type', 'appointment')->where('status', 'approved')->count(),
                'completed' => Schedule::where('type', 'appointment')->where('status', 'completed')->count(),
                'total' => Schedule::where('type', 'appointment')->count(),
            ],
        ];

        return response()->json($stats);
    }

    public function recentActivities()
    {
        $activities = DB::table('activity_log')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($activities);
    }

    private function getChartData()
    {
        $days = 7;
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $data['labels'][] = now()->subDays($i)->format('D');
            $data['visitors'][] = Visitor::whereDate('last_visit_at', $date)->count();
            $data['contacts'][] = Contact::whereDate('created_at', $date)->count();
            $data['bookings'][] = Schedule::whereDate('created_at', $date)->where('type', 'appointment')->count();
        }

        return $data;
    }
}
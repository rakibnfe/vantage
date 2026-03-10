<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\PageView;
use App\Models\Tool;
use App\Models\ToolUsage;
use Illuminate\View\View;

class InsightController extends Controller
{
    /**
     * Display the insights dashboard.
     */
    public function index(): View
    {
        $totalVisitors = Visitor::count();
        $totalPageViews = PageView::count();
        $avgTimeOnSite = 0; // TODO: calculate from analytics

        return view('admin.insights.index', [
            'totalVisitors' => $totalVisitors,
            'totalPageViews' => $totalPageViews,
            'avgTimeOnSite' => $avgTimeOnSite,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;

class ToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Tool::class, 'tool');
    }
}

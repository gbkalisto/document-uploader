<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private $dashboardService;
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard()
    {
        $countArr  =  $this->dashboardService->dashboardCounts();
        return view('admin.dashboard', $countArr);
    }
}

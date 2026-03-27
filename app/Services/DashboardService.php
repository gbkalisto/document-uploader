<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use App\Models\Product;
use App\Models\Document;

class DashboardService
{
    public function dashboardCounts()
    {
        return [
            'user_count' => User::count(),
            'document_count' => Document::count(),
            'recentUsers' => User::with('profile:id,user_id,phone')->withCount('documents')->OrderBy('id', 'desc')->latest()->take(5)->get(),
        ];
    }
}

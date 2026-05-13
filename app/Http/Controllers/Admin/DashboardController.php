<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Product::count();
        $totalOrders   = \App\Models\Order::count();
        $totalUsers    = \App\Models\User::count();
        $totalRevenue  = \App\Models\Order::where('payment_status', 'paid')->sum('total_amount');

        $pendingOrders    = \App\Models\Order::where('status', 'pending')->count();
        $processingOrders = \App\Models\Order::where('status', 'processing')->count();
        $completedOrders  = \App\Models\Order::where('status', 'completed')->count();

        $recentOrders = \App\Models\Order::with('user')
            ->latest()
            ->take(8)
            ->get();

        // Monthly revenue for the last 6 months
        $monthlyRevenue = \App\Models\Order::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalUsers', 'totalRevenue',
            'pendingOrders', 'processingOrders', 'completedOrders',
            'recentOrders', 'monthlyRevenue'
        ));
    }
}

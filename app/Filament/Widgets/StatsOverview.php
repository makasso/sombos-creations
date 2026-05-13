<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $lowStock = Product::where('stock', '<', 5)->count();

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('From paid orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Total Orders', $totalOrders)
                ->description($pendingOrders . ' pending')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([3, 5, 2, 7, 4, 6, 5]),

            Stat::make('Products', $totalProducts)
                ->description($lowStock . ' low stock')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStock > 0 ? 'danger' : 'success')
                ->chart([4, 5, 6, 4, 3, 5, 7]),

            Stat::make('Customers', $totalCustomers)
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([2, 3, 4, 3, 5, 4, 6]),
        ];
    }
}


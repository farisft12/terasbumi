<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'monthly'); // daily, monthly, semester, yearly, all
        
        // Base query
        $query = Order::query();
        
        // Filter berdasarkan periode
        switch ($period) {
            case 'daily':
                $query->whereDate('invoice_date', now()->format('Y-m-d'));
                $periodLabel = 'Hari Ini';
                break;
                
            case 'monthly':
                $query->whereYear('invoice_date', now()->year)
                      ->whereMonth('invoice_date', now()->month);
                $periodLabel = 'Bulan Ini';
                break;
                
            case 'semester':
                $currentMonth = now()->month;
                $year = now()->year;
                if ($currentMonth >= 1 && $currentMonth <= 6) {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 1)
                          ->whereMonth('invoice_date', '<=', 6);
                    $periodLabel = 'Semester 1 Tahun ' . $year;
                } else {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 7)
                          ->whereMonth('invoice_date', '<=', 12);
                    $periodLabel = 'Semester 2 Tahun ' . $year;
                }
                break;
                
            case 'yearly':
                $query->whereYear('invoice_date', now()->year);
                $periodLabel = 'Tahun Ini';
                break;
                
            default:
                $periodLabel = 'Semua Periode';
                break;
        }
        
        // Optimize: Use select only needed columns and eager load items
        $orders = $query->select('id', 'total_price', 'invoice_date')
            ->with(['items' => function ($query) {
                $query->select('id', 'order_id', 'original_price');
            }])
            ->get();
        
        // Calculate totals efficiently
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_price');
        $totalExpenses = $orders->sum(function ($order) {
            return $order->items->sum('original_price') ?? 0;
        });
        $totalProfit = $totalRevenue - $totalExpenses;
        
        // Get recent orders (all time) - optimized with select and cache
        $cacheKey = 'recent_orders_' . auth()->id();
        $recentOrders = Cache::remember($cacheKey, 60, function () {
            return Order::select('id', 'order_number', 'customer_name', 'total_price', 'invoice_date', 'created_at', 'user_id')
                ->with(['items' => function ($query) {
                    $query->select('id', 'order_id', 'service_type', 'price');
                }, 'user:id,name'])
                ->latest('invoice_date')
                ->take(5)
                ->get();
        });

        $summary = [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'total_expenses' => $totalExpenses,
            'total_profit' => $totalProfit,
            'revenue_formatted' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            'expenses_formatted' => 'Rp ' . number_format($totalExpenses, 0, ',', '.'),
            'profit_formatted' => 'Rp ' . number_format($totalProfit, 0, ',', '.'),
            'period_label' => $periodLabel,
        ];

        return view('admin.dashboard', compact('summary', 'recentOrders', 'period'));
    }
}

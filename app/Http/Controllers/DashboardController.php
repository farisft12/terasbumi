<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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
        
        // Get orders with items
        $orders = $query->with('items')->get();
        
        // Calculate totals
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_price');
        $totalExpenses = $orders->sum(function ($order) {
            return $order->items->sum('original_price') ?? 0;
        });
        $totalProfit = $totalRevenue - $totalExpenses;
        
        // Get recent orders (all time)
        $recentOrders = Order::with(['items', 'user'])
            ->latest('invoice_date')
            ->take(5)
            ->get();

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

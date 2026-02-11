<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $period = $request->get('period', 'all'); // all, daily, monthly, semester, yearly
        $date = $request->get('date', now()->format('Y-m-d'));
        $month = $request->get('month', now()->format('Y-m'));
        $year = $request->get('year', now()->format('Y'));
        
        // Optimize: Select only needed columns
        $query = Order::select('id', 'order_number', 'customer_name', 'customer_phone', 'total_price', 'invoice_date', 'created_at', 'user_id')
            ->with(['items' => function ($q) {
                $q->select('id', 'order_id', 'original_price');
            }, 'user:id,name']);
        
        // Filter berdasarkan periode
        switch ($period) {
            case 'daily':
                $query->whereDate('invoice_date', $date);
                $periodLabel = 'Harian - ' . Carbon::parse($date)->format('d F Y');
                break;
                
            case 'monthly':
                $query->whereYear('invoice_date', Carbon::parse($month)->year)
                      ->whereMonth('invoice_date', Carbon::parse($month)->month);
                $periodLabel = 'Bulanan - ' . Carbon::parse($month)->format('F Y');
                break;
                
            case 'semester':
                $year = (int) $year;
                $semester = $request->get('semester', 1); // 1 or 2
                if ($semester == 1) {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 1)
                          ->whereMonth('invoice_date', '<=', 6);
                    $periodLabel = 'Semester 1 - ' . $year;
                } else {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 7)
                          ->whereMonth('invoice_date', '<=', 12);
                    $periodLabel = 'Semester 2 - ' . $year;
                }
                break;
                
            case 'yearly':
                $query->whereYear('invoice_date', $year);
                $periodLabel = 'Tahunan - ' . $year;
                break;
                
            default:
                $periodLabel = 'Semua Periode';
                break;
        }
        
        $orders = $query->latest('invoice_date')->get();

        // Calculate totals
        $totalSellingPrice = $orders->sum('total_price');
        $totalOriginalPrice = $orders->sum(function ($order) {
            return $order->items->sum('original_price') ?? 0;
        });
        $totalProfit = $totalSellingPrice - $totalOriginalPrice;

        return view('admin.laporan', compact('orders', 'totalSellingPrice', 'totalOriginalPrice', 'totalProfit', 'period', 'periodLabel', 'date', 'month', 'year'));
    }

    public function print(Request $request): View
    {
        $period = $request->get('period', 'all');
        $date = $request->get('date', now()->format('Y-m-d'));
        $month = $request->get('month', now()->format('Y-m'));
        $year = $request->get('year', now()->format('Y'));
        
        // Optimize: Select only needed columns
        $query = Order::select('id', 'order_number', 'customer_name', 'customer_phone', 'total_price', 'invoice_date', 'created_at', 'user_id')
            ->with(['items' => function ($q) {
                $q->select('id', 'order_id', 'original_price');
            }, 'user:id,name']);
        
        // Filter berdasarkan periode
        switch ($period) {
            case 'daily':
                $query->whereDate('invoice_date', $date);
                $periodLabel = 'Harian - ' . Carbon::parse($date)->format('d F Y');
                break;
                
            case 'monthly':
                $query->whereYear('invoice_date', Carbon::parse($month)->year)
                      ->whereMonth('invoice_date', Carbon::parse($month)->month);
                $periodLabel = 'Bulanan - ' . Carbon::parse($month)->format('F Y');
                break;
                
            case 'semester':
                $year = (int) $year;
                $semester = $request->get('semester', 1);
                if ($semester == 1) {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 1)
                          ->whereMonth('invoice_date', '<=', 6);
                    $periodLabel = 'Semester 1 - ' . $year;
                } else {
                    $query->whereYear('invoice_date', $year)
                          ->whereMonth('invoice_date', '>=', 7)
                          ->whereMonth('invoice_date', '<=', 12);
                    $periodLabel = 'Semester 2 - ' . $year;
                }
                break;
                
            case 'yearly':
                $query->whereYear('invoice_date', $year);
                $periodLabel = 'Tahunan - ' . $year;
                break;
                
            default:
                $periodLabel = 'Semua Periode';
                break;
        }
        
        $orders = $query->latest('invoice_date')->get();

        // Calculate totals
        $totalSellingPrice = $orders->sum('total_price');
        $totalOriginalPrice = $orders->sum(function ($order) {
            return $order->items->sum('original_price') ?? 0;
        });
        $totalProfit = $totalSellingPrice - $totalOriginalPrice;

        return view('admin.laporan-print', compact('orders', 'totalSellingPrice', 'totalOriginalPrice', 'totalProfit', 'periodLabel'));
    }
}

@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan Keuangan')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-earth-brown-dark">Laporan Keuangan</h2>
            <p class="text-sm text-earth-brown">{{ $periodLabel ?? 'Rekap harga jual dan harga asli semua pesanan' }}</p>
        </div>
    </div>

    <!-- Filter Periode -->
    <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 mb-6">
        <form method="GET" action="{{ route('admin.laporan') }}" id="filterForm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Periode</label>
                    <select name="period" id="period" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                        <option value="all" {{ ($period ?? 'all') === 'all' ? 'selected' : '' }}>Semua Periode</option>
                        <option value="daily" {{ ($period ?? '') === 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="monthly" {{ ($period ?? '') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="semester" {{ ($period ?? '') === 'semester' ? 'selected' : '' }}>Semester</option>
                        <option value="yearly" {{ ($period ?? '') === 'yearly' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>
                
                <div id="daily-filter" class="hidden">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Tanggal</label>
                    <input type="date" name="date" value="{{ $date ?? now()->format('Y-m-d') }}" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                </div>
                
                <div id="monthly-filter" class="hidden">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Bulan</label>
                    <input type="month" name="month" value="{{ $month ?? now()->format('Y-m') }}" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                </div>
                
                <div id="semester-filter" class="hidden">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Semester</label>
                    <select name="semester" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                        <option value="1" {{ (request('semester', '1')) == '1' ? 'selected' : '' }}>Semester 1 (Jan-Jun)</option>
                        <option value="2" {{ (request('semester', '1')) == '2' ? 'selected' : '' }}>Semester 2 (Jul-Des)</option>
                    </select>
                </div>
                
                <div id="year-filter" class="hidden">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Tahun</label>
                    <input type="number" name="year" value="{{ $year ?? now()->format('Y') }}" min="2020" max="{{ now()->year + 1 }}" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                </div>
                
                <div id="semester-year-filter" class="hidden">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-2">Tahun</label>
                    <input type="number" name="year" value="{{ $year ?? now()->format('Y') }}" min="2020" max="{{ now()->year + 1 }}" class="w-full px-3 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-natural-green hover:bg-natural-green-dark text-white rounded-lg transition-colors text-sm font-medium">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-earth-brown mb-1">Total Harga Jual</p>
                    <p class="text-2xl font-bold text-earth-green">Rp {{ number_format($totalSellingPrice, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-earth-green/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-earth-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-earth-brown mb-1">Total Harga Asli</p>
                    <p class="text-2xl font-bold text-earth-orange">Rp {{ number_format($totalOriginalPrice, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-earth-orange/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-earth-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-earth-brown mb-1">Total Profit</p>
                    <p class="text-2xl font-bold {{ $totalProfit >= 0 ? 'text-earth-green' : 'text-red-600' }}">Rp {{ number_format($totalProfit, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-earth-green/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-earth-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl shadow-sm border border-cream-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-cream border-b border-cream-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">No. Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Tanggal Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Harga Jual</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Harga Asli</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Profit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-dark">
                    @forelse($orders as $order)
                        @php
                            $orderOriginalPrice = $order->items->sum('original_price') ?? 0;
                            $orderProfit = $order->total_price - $orderOriginalPrice;
                        @endphp
                        <tr class="hover:bg-cream/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-earth-brown-dark">{{ $order->order_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-earth-brown">
                                    {{ ($order->invoice_date ?? $order->created_at)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-earth-brown-dark">{{ $order->customer_name }}</div>
                                <div class="text-xs text-earth-brown">{{ $order->customer_phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-earth-green">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-earth-orange">
                                    Rp {{ number_format($orderOriginalPrice, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold {{ $orderProfit >= 0 ? 'text-earth-green' : 'text-red-600' }}">
                                    Rp {{ number_format($orderProfit, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-earth-brown">
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-cream border-t-2 border-cream-dark">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-semibold text-earth-brown-dark">
                            TOTAL:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-earth-green">
                                Rp {{ number_format($totalSellingPrice, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-earth-orange">
                                Rp {{ number_format($totalOriginalPrice, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold {{ $totalProfit >= 0 ? 'text-earth-green' : 'text-red-600' }}">
                                Rp {{ number_format($totalProfit, 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const periodSelect = document.getElementById('period');
    const dailyFilter = document.getElementById('daily-filter');
    const monthlyFilter = document.getElementById('monthly-filter');
    const semesterFilter = document.getElementById('semester-filter');
    const yearFilter = document.getElementById('year-filter');
    
    function toggleFilters() {
        const period = periodSelect.value;
        const semesterYearFilter = document.getElementById('semester-year-filter');
        
        // Hide all filters
        dailyFilter.classList.add('hidden');
        monthlyFilter.classList.add('hidden');
        semesterFilter.classList.add('hidden');
        yearFilter.classList.add('hidden');
        if (semesterYearFilter) semesterYearFilter.classList.add('hidden');
        
        // Show relevant filters
        if (period === 'daily') {
            dailyFilter.classList.remove('hidden');
        } else if (period === 'monthly') {
            monthlyFilter.classList.remove('hidden');
        } else if (period === 'semester') {
            semesterFilter.classList.remove('hidden');
            if (semesterYearFilter) semesterYearFilter.classList.remove('hidden');
        } else if (period === 'yearly') {
            yearFilter.classList.remove('hidden');
        }
    }
    
    periodSelect.addEventListener('change', toggleFilters);
    toggleFilters(); // Initialize on page load
});
</script>
@endsection

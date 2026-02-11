@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-earth-brown-dark mb-2">Dashboard Admin</h1>
            <p class="text-earth-brown">{{ $summary['period_label'] ?? 'Sistem Internal Teras Bumi Tour' }}</p>
        </div>
        
        <!-- Filter Periode -->
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <select name="period" onchange="this.form.submit()" class="px-4 py-2 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm bg-white">
                <option value="daily" {{ ($period ?? 'monthly') === 'daily' ? 'selected' : '' }}>Hari Ini</option>
                <option value="monthly" {{ ($period ?? 'monthly') === 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                <option value="semester" {{ ($period ?? 'monthly') === 'semester' ? 'selected' : '' }}>Semester Ini</option>
                <option value="yearly" {{ ($period ?? 'monthly') === 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                <option value="all" {{ ($period ?? 'monthly') === 'all' ? 'selected' : '' }}>Semua Periode</option>
            </select>
        </form>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-cream-dark">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-earth-brown/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-earth-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-earth-brown-light bg-cream px-2 py-1 rounded">Total</span>
            </div>
            <h3 class="text-sm font-medium text-earth-brown mb-1">Total Pesanan</h3>
            <p class="text-3xl font-bold text-earth-brown-dark">{{ $summary['total_orders'] }}</p>
            <p class="text-xs text-earth-brown mt-2">Pesanan aktif dan selesai</p>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-cream-dark">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-natural-green/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-natural-green bg-natural-green/10 px-2 py-1 rounded">Pendapatan</span>
            </div>
            <h3 class="text-sm font-medium text-earth-brown mb-1">Total Pendapatan</h3>
            <p class="text-2xl font-bold text-earth-brown-dark">{{ $summary['revenue_formatted'] }}</p>
            <p class="text-xs text-earth-brown mt-2">Dari semua pesanan</p>
        </div>

        <!-- Total Expenses Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-cream-dark">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-sunset-orange/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-sunset-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-sunset-orange-dark bg-sunset-orange/10 px-2 py-1 rounded">Biaya</span>
            </div>
            <h3 class="text-sm font-medium text-earth-brown mb-1">Total Biaya</h3>
            <p class="text-2xl font-bold text-earth-brown-dark">{{ $summary['expenses_formatted'] }}</p>
            <p class="text-xs text-earth-brown mt-2">Operasional dan lainnya</p>
        </div>

        <!-- Total Profit Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-cream-dark">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded">Keuntungan</span>
            </div>
            <h3 class="text-sm font-medium text-earth-brown mb-1">Total Keuntungan</h3>
            <p class="text-2xl font-bold text-green-700">{{ $summary['profit_formatted'] }}</p>
            <p class="text-xs text-earth-brown mt-2">Margin bersih</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-cream-dark mb-8">
        <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.orders.create') }}" class="flex items-center p-4 bg-cream rounded-lg hover:bg-earth-brown/5 transition-colors group">
                <div class="w-10 h-10 bg-earth-brown rounded-lg flex items-center justify-center mr-4 group-hover:bg-earth-brown-dark transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-earth-brown-dark">Tambah Pesanan</p>
                    <p class="text-sm text-earth-brown">Buat pesanan baru</p>
                </div>
            </a>

            <a href="{{ route('admin.pesanan') }}" class="flex items-center p-4 bg-cream rounded-lg hover:bg-earth-brown/5 transition-colors group">
                <div class="w-10 h-10 bg-natural-green rounded-lg flex items-center justify-center mr-4 group-hover:bg-natural-green-dark transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-earth-brown-dark">Lihat Pesanan</p>
                    <p class="text-sm text-earth-brown">Kelola semua pesanan</p>
                </div>
            </a>

            <a href="{{ route('admin.laporan') }}" class="flex items-center p-4 bg-cream rounded-lg hover:bg-earth-brown/5 transition-colors group">
                <div class="w-10 h-10 bg-sunset-orange rounded-lg flex items-center justify-center mr-4 group-hover:bg-sunset-orange-dark transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-earth-brown-dark">Lihat Laporan</p>
                    <p class="text-sm text-earth-brown">Ringkasan transaksi</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    @if(isset($recentOrders) && $recentOrders->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark mb-8">
            <div class="p-6 border-b border-cream-dark">
                <h3 class="text-lg font-semibold text-earth-brown-dark">Pesanan Terbaru</h3>
                <p class="text-sm text-earth-brown mt-1">5 pesanan terakhir</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-cream border-b border-cream-dark">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">No. Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-dark">
                        @foreach($recentOrders as $order)
                            <tr class="hover:bg-cream/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-earth-brown-dark">{{ $order->order_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-earth-brown-dark">{{ $order->customer_name }}</div>
                                    <div class="text-xs text-earth-brown">{{ $order->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-earth-brown">
                                        {{ ($order->invoice_date ?? $order->created_at)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-earth-green">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="text-earth-green hover:text-earth-olive transition-colors" title="Lihat Invoice">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Info Section -->
    <div class="bg-earth-brown/5 rounded-xl p-6 border border-earth-brown/10">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 bg-earth-brown rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold text-earth-brown-dark mb-1">Selamat Datang di Sistem Admin</h4>
                <p class="text-sm text-earth-brown leading-relaxed">
                    Dashboard ini menampilkan ringkasan data penjualan dan keuangan dari database. Gunakan menu sidebar untuk mengakses fitur lengkap seperti manajemen pesanan, invoice, dan laporan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

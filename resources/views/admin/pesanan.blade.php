@extends('layouts.admin')

@section('title', 'Pesanan')
@section('page-title', 'Manajemen Pesanan')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-earth-brown-dark">Daftar Pesanan</h2>
            <p class="text-sm text-earth-brown">Kelola pesanan perjalanan pelanggan</p>
        </div>
        <a 
            href="{{ route('admin.orders.create') }}" 
            class="px-4 py-2 bg-natural-green hover:bg-natural-green-dark text-white rounded-lg transition-colors text-sm font-medium flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Buat Pesanan Baru</span>
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-600 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)
        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-cream border-b border-cream-dark">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">No. Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Kontak</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Layanan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-earth-brown-dark uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-dark">
                        @foreach($orders as $order)
                            <tr class="hover:bg-cream/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-earth-brown-dark">{{ $order->order_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-earth-brown-dark">{{ $order->customer_name }}</div>
                                    @if($order->customer_email)
                                        <div class="text-xs text-earth-brown">{{ $order->customer_email }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-earth-brown">{{ $order->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($order->items as $item)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-earth-orange/10 text-earth-orange">
                                                {{ ucfirst(str_replace('_', ' ', $item->service_type)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-earth-brown-dark">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusColor = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-earth-brown">
                                        {{ $order->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="text-earth-green hover:text-earth-olive transition-colors" title="Lihat Invoice">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.orders.kwitansi', $order) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors" title="Lihat Kwitansi">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2V5zM9 10h.01M15 10h.01"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.orders.edit', $order) }}" class="text-earth-orange hover:text-earth-orange/80 transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-cream-dark">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl p-8 shadow-sm border border-cream-dark text-center">
            <div class="w-16 h-16 bg-earth-brown/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-earth-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-2">Belum Ada Pesanan</h3>
            <p class="text-earth-brown mb-4">Mulai dengan membuat pesanan baru untuk pelanggan.</p>
            <a 
                href="{{ route('admin.orders.create') }}" 
                class="inline-flex items-center space-x-2 px-4 py-2 bg-earth-brown hover:bg-earth-brown-dark text-white rounded-lg transition-colors text-sm font-medium"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Buat Pesanan Pertama</span>
            </a>
        </div>
    @endif
</div>
@endsection

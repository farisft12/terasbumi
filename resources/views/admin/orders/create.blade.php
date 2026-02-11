@extends('layouts.admin')

@section('title', 'Buat Pesanan')
@section('page-title', 'Buat Pesanan')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm text-earth-brown">Input pesanan perjalanan pelanggan</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <h3 class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</h3>
            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.orders.store') }}" id="orderForm" class="space-y-6">
        @csrf

        <!-- Data Pelanggan -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Data Pelanggan</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="customer_name" class="block text-sm font-medium text-earth-brown-dark mb-1.5">
                        Nama Pelanggan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="customer_name"
                        name="customer_name" 
                        value="{{ old('customer_name') }}"
                        required 
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="Nama lengkap pelanggan"
                    >
                </div>

                <div>
                    <label for="customer_phone" class="block text-sm font-medium text-earth-brown-dark mb-1.5">
                        Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="customer_phone"
                        name="customer_phone" 
                        value="{{ old('customer_phone') }}"
                        required 
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="081234567890"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="customer_email" class="block text-sm font-medium text-earth-brown-dark mb-1.5">
                        Email (Opsional)
                    </label>
                    <input 
                        type="email" 
                        id="customer_email"
                        name="customer_email" 
                        value="{{ old('customer_email') }}"
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                        placeholder="pelanggan@example.com"
                    >
                </div>
            </div>
        </div>

        <!-- Jenis Layanan -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Tambah Layanan</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <button type="button" class="add-service-btn flex items-center justify-center space-x-2 p-3 border border-cream-dark rounded-lg hover:bg-cream transition-colors text-sm font-medium text-earth-brown-dark" data-service-type="tiket_pesawat">
                    <svg class="w-5 h-5 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tiket Pesawat</span>
                </button>

                <button type="button" class="add-service-btn flex items-center justify-center space-x-2 p-3 border border-cream-dark rounded-lg hover:bg-cream transition-colors text-sm font-medium text-earth-brown-dark" data-service-type="hotel">
                    <svg class="w-5 h-5 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Hotel</span>
                </button>

                <button type="button" class="add-service-btn flex items-center justify-center space-x-2 p-3 border border-cream-dark rounded-lg hover:bg-cream transition-colors text-sm font-medium text-earth-brown-dark" data-service-type="sewa_mobil">
                    <svg class="w-5 h-5 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Sewa Mobil</span>
                </button>

                <button type="button" class="add-service-btn flex items-center justify-center space-x-2 p-3 border border-cream-dark rounded-lg hover:bg-cream transition-colors text-sm font-medium text-earth-brown-dark" data-service-type="taksi">
                    <svg class="w-5 h-5 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Taksi</span>
                </button>

                <button type="button" class="add-service-btn flex items-center justify-center space-x-2 p-3 border border-cream-dark rounded-lg hover:bg-cream transition-colors text-sm font-medium text-earth-brown-dark" data-service-type="lainnya">
                    <svg class="w-5 h-5 text-natural-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Lainnya</span>
                </button>
            </div>
        </div>

        <!-- Detail Layanan (Dynamic) -->
        <div id="serviceItems" class="space-y-4">
            <!-- Items will be added here dynamically -->
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6">
            <h3 class="text-lg font-semibold text-earth-brown-dark mb-4">Ringkasan Pesanan</h3>
            
            <div class="space-y-4">
                <div>
                    <label for="invoice_date" class="block text-sm font-medium text-earth-brown-dark mb-1.5">
                        Tanggal Invoice
                    </label>
                    <input 
                        type="date" 
                        id="invoice_date"
                        name="invoice_date" 
                        value="{{ old('invoice_date', date('Y-m-d')) }}"
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm"
                    >
                </div>

                <div class="flex justify-between items-center py-2 border-b border-cream-dark">
                    <span class="text-sm font-medium text-earth-brown-dark">Total Harga</span>
                    <span id="totalPrice" class="text-lg font-semibold text-natural-green">Rp 0</span>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-earth-brown-dark mb-1.5">
                        Catatan Tambahan
                    </label>
                    <textarea 
                        id="notes"
                        name="notes" 
                        rows="3"
                        class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm resize-none"
                        placeholder="Catatan khusus untuk pesanan ini..."
                    >{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-3 justify-end">
            <a 
                href="{{ route('admin.pesanan') }}" 
                class="px-6 py-2.5 border border-cream-dark rounded-lg text-earth-brown-dark hover:bg-cream transition-colors text-center text-sm font-medium"
            >
                Batal
            </a>
            <button 
                type="submit" 
                name="action"
                value="save"
                class="px-6 py-2.5 bg-earth-brown hover:bg-earth-brown-dark text-white rounded-lg transition-colors text-sm font-medium"
            >
                Simpan Pesanan
            </button>
            <button 
                type="submit" 
                name="action"
                value="save_and_invoice"
                class="px-6 py-2.5 bg-natural-green hover:bg-natural-green-dark text-white rounded-lg transition-colors text-sm font-medium"
            >
                Simpan & Buat Invoice
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let itemIndex = 0;
const serviceTemplates = {
    tiket_pesawat: `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Maskapai <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][maskapai]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Garuda Indonesia">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Rute (Asal - Tujuan) <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][rute]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Jakarta - Bali">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Nomor Tiket <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][nomor_tiket]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="1234567890">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Nomor Penerbangan <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][nomor_penerbangan]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="GA123">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Tanggal Keberangkatan <span class="text-red-500">*</span></label>
                <input type="date" name="items[__INDEX__][tanggal_keberangkatan]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Jumlah Penumpang <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][jumlah_penumpang]" required min="1" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="2">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Jual <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][price]" required min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm price-input" placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Asli (Opsional)</label>
                <input type="number" name="items[__INDEX__][original_price]" min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="0">
            </div>
        </div>
    `,
    hotel: `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Nama Hotel <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][nama_hotel]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Hotel Grand Bali">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Kota <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][kota]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Bali">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Check-in <span class="text-red-500">*</span></label>
                <input type="date" name="items[__INDEX__][check_in]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm hotel-date-input" data-index="__INDEX__">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Check-out <span class="text-red-500">*</span></label>
                <input type="date" name="items[__INDEX__][check_out]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm hotel-date-input" data-index="__INDEX__">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Jumlah Kamar <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][jumlah_kamar]" required min="1" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm hotel-room-input" data-index="__INDEX__" placeholder="1">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga per Malam <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][harga_per_malam]" required min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm hotel-price-input" data-index="__INDEX__" placeholder="0">
                <input type="hidden" name="items[__INDEX__][price]" class="hotel-total-price" data-index="__INDEX__">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Asli (Opsional)</label>
                <input type="number" name="items[__INDEX__][original_price]" min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="0">
            </div>
            <div class="md:col-span-2">
                <div class="bg-cream rounded-lg p-3 border border-cream-dark">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-earth-brown">Jumlah Hari:</span>
                        <span class="font-semibold text-earth-brown-dark hotel-days" data-index="__INDEX__">0 hari</span>
                    </div>
                    <div class="flex items-center justify-between text-sm mt-2">
                        <span class="text-earth-brown">Total Harga:</span>
                        <span class="font-semibold text-natural-green hotel-total-display" data-index="__INDEX__">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    `,
    sewa_mobil: `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Jenis Mobil <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][jenis_mobil]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Avanza">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Durasi Sewa <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][durasi_sewa]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="3 hari">
            </div>
            <div>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="items[__INDEX__][dengan_sopir]" value="1" class="w-4 h-4 rounded border-cream-dark text-natural-green focus:ring-natural-green">
                    <span class="text-sm font-medium text-earth-brown-dark">Dengan Sopir</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Jual <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][price]" required min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm price-input" placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Asli (Opsional)</label>
                <input type="number" name="items[__INDEX__][original_price]" min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="0">
            </div>
        </div>
    `,
    taksi: `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Rute Perjalanan <span class="text-red-500">*</span></label>
                <input type="text" name="items[__INDEX__][rute_perjalanan]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="Bandara - Hotel">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                <input type="date" name="items[__INDEX__][tanggal]" required class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Jual <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][price]" required min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm price-input" placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Asli (Opsional)</label>
                <input type="number" name="items[__INDEX__][original_price]" min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="0">
            </div>
        </div>
    `,
    lainnya: `
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Deskripsi Layanan <span class="text-red-500">*</span></label>
                <textarea name="items[__INDEX__][deskripsi]" required rows="3" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm resize-none" placeholder="Jelaskan layanan yang diminta..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Jual <span class="text-red-500">*</span></label>
                <input type="number" name="items[__INDEX__][price]" required min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm price-input" placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Harga Asli (Opsional)</label>
                <input type="number" name="items[__INDEX__][original_price]" min="0" step="0.01" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm" placeholder="0">
            </div>
        </div>
    `
};

const serviceLabels = {
    tiket_pesawat: 'Tiket Pesawat',
    hotel: 'Hotel',
    sewa_mobil: 'Sewa Mobil',
    taksi: 'Taksi',
    lainnya: 'Lainnya'
};

document.addEventListener('DOMContentLoaded', function() {
    const addServiceButtons = document.querySelectorAll('.add-service-btn');
    const serviceItemsContainer = document.getElementById('serviceItems');

    addServiceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceType = this.dataset.serviceType;
            addServiceItem(serviceType);
        });
    });

    // Calculate total on price input change
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('price-input')) {
            calculateTotal();
        }
        
        // Handle hotel calculation
        if (e.target.classList.contains('hotel-date-input') || 
            e.target.classList.contains('hotel-room-input') || 
            e.target.classList.contains('hotel-price-input')) {
            calculateHotelPrice(e.target);
        }
    });
    
    // Use event delegation for remove buttons to handle dynamically added items
    if (serviceItemsContainer) {
        serviceItemsContainer.addEventListener('click', function(e) {
            // Check if clicked element is remove button or inside remove button
            const removeBtn = e.target.closest('.remove-item');
            if (removeBtn) {
                e.preventDefault();
                e.stopPropagation();
                // Find the parent item container
                const itemElement = removeBtn.closest('[data-item-id]') || removeBtn.closest('[data-service-type]');
                if (itemElement) {
                    itemElement.remove();
                    calculateTotal();
                }
            }
        });
    }
    
    // Calculate hotel price
    function calculateHotelPrice(input) {
        const index = input.dataset.index;
        const checkInInput = document.querySelector(`input[name="items[${index}][check_in]"]`);
        const checkOutInput = document.querySelector(`input[name="items[${index}][check_out]"]`);
        const roomInput = document.querySelector(`input[name="items[${index}][jumlah_kamar]"]`);
        const priceInput = document.querySelector(`input[name="items[${index}][harga_per_malam]"]`);
        const totalPriceInput = document.querySelector(`input.hotel-total-price[data-index="${index}"]`);
        const daysDisplay = document.querySelector(`.hotel-days[data-index="${index}"]`);
        const totalDisplay = document.querySelector(`.hotel-total-display[data-index="${index}"]`);
        
        if (!checkInInput || !checkOutInput || !roomInput || !priceInput || !totalPriceInput) {
            return;
        }
        
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const rooms = parseInt(roomInput.value) || 0;
        const pricePerNight = parseFloat(priceInput.value) || 0;
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const diffTime = Math.abs(checkOut - checkIn);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            const totalPrice = pricePerNight * diffDays * rooms;
            
            if (daysDisplay) {
                daysDisplay.textContent = `${diffDays} hari`;
            }
            
            if (totalPriceInput) {
                totalPriceInput.value = totalPrice.toFixed(2);
            }
            
            if (totalDisplay) {
                totalDisplay.textContent = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(totalPrice);
            }
        } else {
            if (daysDisplay) {
                daysDisplay.textContent = '0 hari';
            }
            if (totalPriceInput) {
                totalPriceInput.value = '0';
            }
            if (totalDisplay) {
                totalDisplay.textContent = 'Rp 0';
            }
        }
        
        calculateTotal();
    }

    function addServiceItem(serviceType) {
        const itemId = `item-${itemIndex}`;
        const template = serviceTemplates[serviceType].replace(/__INDEX__/g, itemIndex);
        
        const itemHtml = `
            <div class="bg-white rounded-xl shadow-sm border border-cream-dark p-6" data-service-type="${serviceType}" data-item-id="${itemId}">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-base font-semibold text-earth-brown-dark">${serviceLabels[serviceType]}</h4>
                    <button type="button" class="text-red-500 hover:text-red-700 text-sm font-medium remove-item" data-service-type="${serviceType}">
                        Hapus
                    </button>
                </div>
                <input type="hidden" name="items[${itemIndex}][service_type]" value="${serviceType}">
                ${template}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-earth-brown-dark mb-1.5">Catatan (Opsional)</label>
                    <textarea name="items[${itemIndex}][notes]" rows="2" class="w-full px-3 py-2.5 border border-cream-dark rounded-lg focus:border-natural-green focus:ring-2 focus:ring-natural-green/20 outline-none transition-all text-sm resize-none" placeholder="Catatan khusus untuk layanan ini..."></textarea>
                </div>
            </div>
        `;

        serviceItemsContainer.insertAdjacentHTML('beforeend', itemHtml);
        
        // Get the newly added element
        const newItemElement = serviceItemsContainer.querySelector(`[data-item-id="${itemId}"]`);
        
        if (!newItemElement) {
            console.error('Failed to find newly added item element');
            return;
        }
        
        // If hotel, set up calculation
        if (serviceType === 'hotel') {
            const hotelInputs = newItemElement.querySelectorAll('.hotel-date-input, .hotel-room-input, .hotel-price-input');
            hotelInputs.forEach(input => {
                input.dataset.index = itemIndex;
                input.addEventListener('input', function() {
                    calculateHotelPrice(this);
                });
            });
            
            // Update display elements
            const daysDisplay = newItemElement.querySelector('.hotel-days');
            const totalDisplay = newItemElement.querySelector('.hotel-total-display');
            const totalPriceInput = newItemElement.querySelector('.hotel-total-price');
            if (daysDisplay) daysDisplay.dataset.index = itemIndex;
            if (totalDisplay) totalDisplay.dataset.index = itemIndex;
            if (totalPriceInput) totalPriceInput.dataset.index = itemIndex;
        }
        
        // Remove event is handled by event delegation, no need to attach here
        itemIndex++;
    }


    function calculateTotal() {
        let total = 0;
        
        // Calculate from regular price inputs
        const priceInputs = document.querySelectorAll('.price-input');
        priceInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });
        
        // Calculate from hotel total prices
        const hotelTotalInputs = document.querySelectorAll('.hotel-total-price');
        hotelTotalInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });

        const totalPriceElement = document.getElementById('totalPrice');
        if (totalPriceElement) {
            totalPriceElement.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);
        }
    }

    // Handle form submission
    const form = document.getElementById('orderForm');
    form.addEventListener('submit', function(e) {
        const submitButton = document.activeElement;
        if (submitButton && submitButton.name === 'action' && submitButton.value === 'save_and_invoice') {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'create_invoice';
            input.value = '1';
            form.appendChild(input);
        }
    });
});
</script>
@endpush
@endsection

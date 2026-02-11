<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        // Optimize: Select only needed columns and eager load relationships
        $orders = Order::select('id', 'order_number', 'customer_name', 'customer_phone', 'customer_email', 'total_price', 'invoice_date', 'created_at', 'user_id')
            ->with(['user:id,name', 'items' => function ($query) {
                $query->select('id', 'order_id', 'service_type', 'price');
            }])
            ->latest()
            ->paginate(15);

        return view('admin.pesanan', compact('orders'));
    }

    public function create(): View
    {
        return view('admin.orders.create');
    }

    public function edit(Order $order): View
    {
        // Optimize: Load items with only needed columns
        $order->load(['items' => function ($query) {
            $query->select('id', 'order_id', 'service_type', 'service_data', 'price', 'original_price', 'notes');
        }]);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(StoreOrderRequest $request, Order $order): RedirectResponse
    {
        $validated = $request->validated();

        // Calculate total price
        $totalPrice = collect($validated['items'])->sum('price');

        // Update order
        $order->update([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'total_price' => $totalPrice,
            'invoice_date' => $validated['invoice_date'] ?? $order->invoice_date ?? now(),
            'notes' => $validated['notes'] ?? null,
        ]);

        // Delete existing items
        $order->items()->delete();

        // Create new order items
        foreach ($validated['items'] as $item) {
            $serviceData = $this->buildServiceData($item);

            OrderItem::create([
                'order_id' => $order->id,
                'service_type' => $item['service_type'],
                'service_data' => $serviceData,
                'price' => $item['price'],
                'original_price' => $item['original_price'] ?? null,
                'notes' => $item['notes'] ?? null,
            ]);
        }

        // Clear cache after update
        Cache::forget('recent_orders_' . auth()->id());

        return redirect()->route('admin.pesanan')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        // Clear cache after delete
        Cache::forget('recent_orders_' . auth()->id());

        return redirect()->route('admin.pesanan')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function showInvoice(Order $order): View
    {
        // Optimize: Load only needed relationships
        $order->load(['items']);

        return view('admin.orders.invoice', compact('order'));
    }

    public function showKwitansi(Order $order): View
    {
        // Optimize: Load only needed relationships
        $order->load(['items']);

        return view('admin.orders.kwitansi', compact('order'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Calculate total price
        $totalPrice = collect($validated['items'])->sum('price');

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'total_price' => $totalPrice,
            'invoice_date' => $validated['invoice_date'] ?? now(),
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items
        foreach ($validated['items'] as $item) {
            $serviceData = $this->buildServiceData($item);

            OrderItem::create([
                'order_id' => $order->id,
                'service_type' => $item['service_type'],
                'service_data' => $serviceData,
                'price' => $item['price'],
                'original_price' => $item['original_price'] ?? null,
                'notes' => $item['notes'] ?? null,
            ]);
        }

        // Clear cache after create
        Cache::forget('recent_orders_' . auth()->id());

        $message = 'Pesanan berhasil dibuat.';

        // Check if user wants to create invoice
        if ($request->input('action') === 'save_and_invoice') {
            return redirect()->route('admin.orders.invoice', $order)
                ->with('success', $message);
        }

        return redirect()->route('admin.pesanan')
            ->with('success', $message);
    }

    private function buildServiceData(array $item): array
    {
        $serviceData = [];

        switch ($item['service_type']) {
            case 'tiket_pesawat':
                $serviceData = [
                    'maskapai' => $item['maskapai'] ?? null,
                    'rute' => $item['rute'] ?? null,
                    'nomor_tiket' => $item['nomor_tiket'] ?? null,
                    'nomor_penerbangan' => $item['nomor_penerbangan'] ?? null,
                    'tanggal_keberangkatan' => $item['tanggal_keberangkatan'] ?? null,
                    'jumlah_penumpang' => $item['jumlah_penumpang'] ?? null,
                ];
                break;

            case 'hotel':
                $checkIn = new \DateTime($item['check_in'] ?? null);
                $checkOut = new \DateTime($item['check_out'] ?? null);
                $jumlahHari = $checkIn && $checkOut ? $checkIn->diff($checkOut)->days : 0;
                $hargaPerMalam = $item['harga_per_malam'] ?? 0;
                $jumlahKamar = $item['jumlah_kamar'] ?? 1;
                
                // Calculate total price: harga per malam * jumlah hari * jumlah kamar
                $totalPrice = $hargaPerMalam * $jumlahHari * $jumlahKamar;
                
                // Update the price in item array
                $item['price'] = $totalPrice;
                
                $serviceData = [
                    'nama_hotel' => $item['nama_hotel'] ?? null,
                    'kota' => $item['kota'] ?? null,
                    'check_in' => $item['check_in'] ?? null,
                    'check_out' => $item['check_out'] ?? null,
                    'jumlah_kamar' => $item['jumlah_kamar'] ?? null,
                    'harga_per_malam' => $hargaPerMalam,
                    'jumlah_hari' => $jumlahHari,
                ];
                break;

            case 'sewa_mobil':
                $serviceData = [
                    'jenis_mobil' => $item['jenis_mobil'] ?? null,
                    'durasi_sewa' => $item['durasi_sewa'] ?? null,
                    'dengan_sopir' => $item['dengan_sopir'] ?? false,
                ];
                break;

            case 'taksi':
                $serviceData = [
                    'rute_perjalanan' => $item['rute_perjalanan'] ?? null,
                    'tanggal' => $item['tanggal'] ?? null,
                ];
                break;

            case 'lainnya':
                $serviceData = [
                    'deskripsi' => $item['deskripsi'] ?? null,
                ];
                break;
        }

        return $serviceData;
    }
}

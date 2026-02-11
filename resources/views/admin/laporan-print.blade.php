<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - {{ $periodLabel }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            font-size: 12px;
            color: #4A3F35;
            background: white;
        }
        
        .print-container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
        }
        
        .no-print {
            display: none;
        }
        
        @media print {
            body {
                background: white;
            }
            
            .no-print {
                display: none !important;
            }
            
            .print-container {
                padding: 0;
            }
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #6B5B4F;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #4A3F35;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            color: #6B5B4F;
        }
        
        .company-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
            color: #6B5B4F;
        }
        
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .summary-card {
            background: #F5F0E8;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #6B5B4F;
            text-align: center;
        }
        
        .summary-card-label {
            font-size: 10px;
            color: #6B5B4F;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .summary-card-value {
            font-size: 18px;
            font-weight: 700;
            color: #4A3F35;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th {
            background: #6B5B4F;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid #4A3F35;
        }
        
        td {
            padding: 8px;
            border: 1px solid #E8DDD0;
            font-size: 11px;
        }
        
        tfoot {
            background: #F5F0E8;
            font-weight: 700;
        }
        
        tfoot td {
            border-top: 2px solid #6B5B4F;
        }
        
        .text-right {
            text-align: right;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #6B5B4F;
            text-align: right;
            font-size: 10px;
            color: #6B5B4F;
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Print Button -->
        <div class="no-print mb-6 text-right">
            <button onclick="window.print()" class="px-6 py-2 bg-earth-brown hover:bg-earth-brown-dark text-white rounded-lg transition-colors font-medium">
                Cetak Laporan
            </button>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Laporan Keuangan</h1>
            <p>Teras Bumi Tour</p>
            <div class="company-info">
                <p>Jl. Brigjend H. Hasan Basri, Komp. Seribu Dinar No.77, Alalak Utara, Banjarmasin Utara</p>
                <p>Telp: 08176628333 | Website: www.terasbumi.site</p>
            </div>
            <p style="margin-top: 10px; font-weight: 600;">Periode: {{ $periodLabel }}</p>
            <p style="font-size: 10px;">Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-card-label">Total Harga Jual</div>
                <div class="summary-card-value" style="color: #5D7A5D;">Rp {{ number_format($totalSellingPrice, 0, ',', '.') }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Total Harga Asli</div>
                <div class="summary-card-value" style="color: #E07A5F;">Rp {{ number_format($totalOriginalPrice, 0, ',', '.') }}</div>
            </div>
            <div class="summary-card">
                <div class="summary-card-label">Total Profit</div>
                <div class="summary-card-value" style="color: {{ $totalProfit >= 0 ? '#5D7A5D' : '#DC2626' }};">Rp {{ number_format($totalProfit, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Orders Table -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Pesanan</th>
                    <th>Tanggal Invoice</th>
                    <th>Pelanggan</th>
                    <th class="text-right">Harga Jual</th>
                    <th class="text-right">Harga Asli</th>
                    <th class="text-right">Profit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $index => $order)
                    @php
                        $orderOriginalPrice = $order->items->sum('original_price') ?? 0;
                        $orderProfit = $order->total_price - $orderOriginalPrice;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ ($order->invoice_date ?? $order->created_at)->format('d M Y') }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($orderOriginalPrice, 0, ',', '.') }}</td>
                        <td class="text-right" style="color: {{ $orderProfit >= 0 ? '#5D7A5D' : '#DC2626' }};">Rp {{ number_format($orderProfit, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center" style="padding: 20px;">
                            Belum ada data pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right" style="font-weight: 700;">TOTAL:</td>
                    <td class="text-right" style="font-weight: 700; color: #5D7A5D;">Rp {{ number_format($totalSellingPrice, 0, ',', '.') }}</td>
                    <td class="text-right" style="font-weight: 700; color: #E07A5F;">Rp {{ number_format($totalOriginalPrice, 0, ',', '.') }}</td>
                    <td class="text-right" style="font-weight: 700; color: {{ $totalProfit >= 0 ? '#5D7A5D' : '#DC2626' }};">Rp {{ number_format($totalProfit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Laporan ini dibuat secara otomatis oleh sistem Teras Bumi Tour</p>
        </div>
    </div>

    <script>
        // Auto print on load if print parameter exists
        if (new URLSearchParams(window.location.search).get('print') === '1') {
            window.onload = function() {
                window.print();
            };
        }
    </script>
</body>
</html>

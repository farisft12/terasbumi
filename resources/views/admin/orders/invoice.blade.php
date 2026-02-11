<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        @page { size: A4; margin: 12mm; }
        
        body {
            font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #e5e7eb; padding: 15px; font-size: 10px;
            line-height: 1.4; color: #4A3F35;
        }
        
        .page-container { max-width: 210mm; margin: 0 auto; }
        
        .print-btn-container { text-align: center; margin-bottom: 10px; }
        .print-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: #5D7A5D; color: white;
            border: none; border-radius: 4px; cursor: pointer;
            font-size: 12px; font-weight: 500;
        }
        
        .invoice-paper {
            background: white; width: 210mm; min-height: auto;
            margin: 0 auto; padding: 15mm; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Header */
        .header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 12px; padding-bottom: 8px; border-bottom: 2px solid #6B5B4F;
        }
        
        .company-brand { display: flex; align-items: center; gap: 10px; }
        .company-logo { width: 45px; height: 45px; object-fit: contain; }
        .company-title h1 { font-size: 18px; font-weight: 700; color: #4A3F35; margin-bottom: 2px; }
        .company-title p { font-size: 10px; color: #6B5B4F; }
        
        .badge-invoice {
            background: #5D7A5D; color: white; padding: 8px 15px;
            border-radius: 4px; text-align: center;
        }
        .badge-invoice .label { font-size: 9px; font-weight: 500; text-transform: uppercase; display: block; }
        .badge-invoice .number { font-size: 12px; font-weight: 700; display: block; }
        
        /* Company Info */
        .company-info {
            display: grid; grid-template-columns: 1fr 1fr; gap: 15px;
            margin-bottom: 12px; padding: 8px 10px; background: #F5F0E8;
            border-radius: 4px; font-size: 9px; color: #6B5B4F;
        }
        .info-group .label { font-weight: 600; color: #4A3F35; margin-bottom: 2px; }
        
        /* Invoice Details */
        .invoice-details {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
            margin-bottom: 12px;
        }
        .detail-box .label { font-size: 9px; font-weight: 600; color: #4A3F35; margin-bottom: 3px; text-transform: uppercase; }
        .detail-box .date { font-size: 11px; color: #6B5B4F; }
        .detail-box .customer-name { font-size: 12px; font-weight: 700; color: #4A3F35; margin-bottom: 2px; }
        .detail-box .customer-contact { font-size: 10px; color: #6B5B4F; }
        
        /* Table */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .items-table thead { background: #6B5B4F; color: white; }
        .items-table th {
            padding: 6px 8px; text-align: left; font-size: 9px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.3px;
        }
        .items-table th:last-child { text-align: right; }
        
        .items-table td {
            padding: 8px; border-bottom: 1px solid #E8DDD0;
            vertical-align: top;
        }
        .items-table td:last-child { text-align: right; }
        .items-table tr:nth-child(even) { background: #FAFAF8; }
        
        .col-no { width: 4%; text-align: center; }
        .col-service { width: 18%; }
        .col-detail { width: 58%; }
        .col-price { width: 20%; }
        
        .service-name { font-weight: 600; color: #4A3F35; margin-bottom: 2px; font-size: 10px; }
        .service-detail { font-size: 9px; color: #6B5B4F; margin-bottom: 1px; }
        .service-detail strong { color: #4A3F35; }
        .item-price { font-weight: 700; color: #4A3F35; font-size: 11px; }
        .item-note { font-size: 8px; color: #6B5B4F; font-style: italic; margin-top: 2px; }
        
        /* Total */
        .total-section { display: flex; justify-content: flex-end; margin-bottom: 15px; }
        .total-box {
            background: linear-gradient(135deg, #F5F0E8 0%, #fff 100%);
            border: 2px solid #6B5B4F; padding: 8px 20px;
            border-radius: 4px; min-width: 200px;
        }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .total-row:last-child { margin-bottom: 0; padding-top: 6px; border-top: 1px solid #6B5B4F; margin-top: 6px; }
        .total-label { font-size: 10px; color: #6B5B4F; }
        .total-value { font-size: 10px; font-weight: 600; color: #4A3F35; }
        .grand-total .total-label { font-size: 12px; font-weight: 700; color: #4A3F35; }
        .grand-total .total-value { font-size: 13px; font-weight: 700; color: #4A3F35; }
        
        /* Notes */
        .notes-section {
            background: #F5F0E8; padding: 10px; border-radius: 4px;
            margin-bottom: 15px; border-left: 3px solid #6B5B4F;
        }
        .notes-section .label { font-weight: 600; color: #4A3F35; margin-bottom: 3px; font-size: 9px; }
        .notes-section .value { font-size: 9px; color: #6B5B4F; }
        
        /* Footer */
        .footer { text-align: center; margin-top: 15px; }
        .footer-text { font-size: 10px; color: #6B5B4F; margin-bottom: 20px; }
        .footer-text strong { color: #4A3F35; display: block; margin-bottom: 2px; }
        
        .signature-section { margin-top: 20px; }
        .signature-box { display: inline-block; text-align: center; width: 140px; }
        .signature-date { font-size: 9px; color: #6B5B4F; margin-bottom: 25px; }
        .signature-line { border-top: 1px solid #6B5B4F; padding-top: 4px; }
        .signature-name { font-weight: 700; color: #4A3F35; font-size: 10px; }
        .signature-title { font-size: 8px; color: #6B5B4F; }
        
        /* Print */
        @media print {
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            body { background: white !important; padding: 0 !important; }
            .print-btn-container { display: none !important; }
            .invoice-paper { box-shadow: none !important; width: 100% !important; padding: 0 !important; }
            
            .badge-invoice { background: #5D7A5D !important; color: white !important; }
            .company-info, .notes-section { background: #F5F0E8 !important; }
            .total-box { background: linear-gradient(135deg, #F5F0E8 0%, #fff 100%) !important; border: 2px solid #6B5B4F !important; }
            .items-table thead { background: #6B5B4F !important; color: white !important; }
            .items-table tr:nth-child(even) { background: #FAFAF8 !important; }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="print-btn-container no-print">
            <button onclick="window.print()" class="print-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Invoice
            </button>
        </div>

        <div class="invoice-paper">
            <!-- Header -->
            <div class="header">
                <div class="company-brand">
                    <img src="{{ asset('img/b1g.png') }}" alt="Logo" class="company-logo">
                    <div class="company-title">
                        <h1>Teras Bumi Tour</h1>
                        <p>Travel Agent Profesional</p>
                    </div>
                </div>
                <div class="badge-invoice">
                    <span class="label">Invoice</span>
                    <span class="number">{{ $order->order_number }}</span>
                </div>
            </div>

            <!-- Company Info -->
            <div class="company-info">
                <div class="info-group">
                    <div class="label">Alamat:</div>
                    <div>Jl. Brigjend H. Hasan Basri, Komp. Seribu Dinar No.77, Alalak Utara, Banjarmasin Utara</div>
                </div>
                <div class="info-group">
                    <div class="label">Kontak:</div>
                    <div>Telp: 08176628333<br>www.terasbumi.site</div>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="invoice-details">
                <div class="detail-box">
                    <div class="label">Tanggal Invoice</div>
                    <div class="date">{{ ($order->invoice_date ?? $order->created_at)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="detail-box">
                    <div class="label">Kepada</div>
                    <div class="customer-name">{{ $order->customer_name }}</div>
                    <div class="customer-contact">{{ $order->customer_phone }}</div>
                    @if($order->customer_email)
                        <div class="customer-contact">{{ $order->customer_email }}</div>
                    @endif
                </div>
            </div>

            <!-- Items Table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-service">Layanan</th>
                        <th class="col-detail">Detail</th>
                        <th class="col-price">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td class="col-no">{{ $index + 1 }}</td>
                            <td class="col-service">
                                <div class="service-name">{{ ucfirst(str_replace('_', ' ', $item->service_type)) }}</div>
                            </td>
                            <td class="col-detail">
                                @php $data = $item->service_data; @endphp
                                
                                @if($item->service_type === 'tiket_pesawat')
                                    <div class="service-detail"><strong>Maskapai:</strong> {{ $data['maskapai'] ?? '-' }} | <strong>Rute:</strong> {{ $data['rute'] ?? '-' }}</div>
                                    @if(isset($data['nomor_tiket']))
                                        <div class="service-detail"><strong>No. Tiket:</strong> {{ $data['nomor_tiket'] }}</div>
                                    @endif
                                    @if(isset($data['nomor_penerbangan']))
                                        <div class="service-detail"><strong>No. Penerbangan:</strong> {{ $data['nomor_penerbangan'] }}</div>
                                    @endif
                                    <div class="service-detail"><strong>Tanggal:</strong> {{ isset($data['tanggal_keberangkatan']) ? \Carbon\Carbon::parse($data['tanggal_keberangkatan'])->translatedFormat('d F Y') : '-' }} | <strong>Penumpang:</strong> {{ $data['jumlah_penumpang'] ?? '-' }} org</div>
                                    
                                @elseif($item->service_type === 'hotel')
                                    <div class="service-detail"><strong>Hotel:</strong> {{ $data['nama_hotel'] ?? '-' }}, {{ $data['kota'] ?? '-' }}</div>
                                    <div class="service-detail"><strong>Check-in:</strong> {{ isset($data['check_in']) ? \Carbon\Carbon::parse($data['check_in'])->translatedFormat('d M Y') : '-' }} | <strong>Check-out:</strong> {{ isset($data['check_out']) ? \Carbon\Carbon::parse($data['check_out'])->translatedFormat('d M Y') : '-' }}</div>
                                    <div class="service-detail"><strong>{{ $data['jumlah_kamar'] ?? 1 }} kamar</strong> | <strong>{{ $data['jumlah_hari'] ?? 0 }} malam</strong></div>
                                    @if(isset($data['harga_per_malam']))
                                        <div class="service-detail"><strong>Harga/malam:</strong> Rp {{ number_format($data['harga_per_malam'], 0, ',', '.') }}</div>
                                    @endif
                                    
                                @elseif($item->service_type === 'sewa_mobil')
                                    <div class="service-detail"><strong>Jenis:</strong> {{ $data['jenis_mobil'] ?? '-' }} | <strong>Durasi:</strong> {{ $data['durasi_sewa'] ?? '-' }}</div>
                                    <div class="service-detail"><strong>Layanan:</strong> {{ ($data['dengan_sopir'] ?? false) ? 'Dengan Sopir' : 'Lepas Kunci' }}</div>
                                    
                                @elseif($item->service_type === 'taksi')
                                    <div class="service-detail"><strong>Rute:</strong> {{ $data['rute_perjalanan'] ?? '-' }}</div>
                                    <div class="service-detail"><strong>Tanggal:</strong> {{ isset($data['tanggal']) ? \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('d F Y') : '-' }}</div>
                                    
                                @elseif($item->service_type === 'lainnya')
                                    <div class="service-detail">{{ $data['deskripsi'] ?? '-' }}</div>
                                @endif
                                
                                @if($item->notes)
                                    <div class="item-note"><strong>Catatan:</strong> {{ $item->notes }}</div>
                                @endif
                            </td>
                            <td class="col-price">
                                <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total -->
            <div class="total-section">
                <div class="total-box">
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">PPN (0%)</span>
                        <span class="total-value">Rp 0</span>
                    </div>
                    <div class="total-row grand-total">
                        <span class="total-label">TOTAL</span>
                        <span class="total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
                <div class="notes-section">
                    <div class="label">Catatan:</div>
                    <div class="value">{{ $order->notes }}</div>
                </div>
            @endif

            <!-- Footer -->
            <div class="footer">
                <div class="footer-text">
                    <strong>Terima Kasih</strong>
                    Terima kasih atas kepercayaan Anda menggunakan layanan Teras Bumi Tour.
                </div>
                
                <div class="signature-section">
                    <div class="signature-box">
                        <div class="signature-date">{{ ($order->invoice_date ?? $order->created_at)->translatedFormat('d F Y') }}</div>
                        <div class="signature-line">
                            <div class="signature-name">Teras Bumi Tour</div>
                            <div class="signature-title">Direktur</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

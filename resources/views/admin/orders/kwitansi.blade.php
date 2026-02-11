<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi - {{ $order->order_number }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        @page { size: A4; margin: 12mm; }
        
        body {
            font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #e5e7eb; padding: 15px; font-size: 11px;
            line-height: 1.4; color: #4A3F35;
        }
        
        .page-container { max-width: 210mm; margin: 0 auto; }
        
        .print-btn-container { text-align: center; margin-bottom: 10px; }
        .print-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: #6B5B4F; color: white;
            border: none; border-radius: 4px; cursor: pointer;
            font-size: 12px; font-weight: 500;
        }
        
        .kwitansi-paper {
            background: white; width: 210mm; min-height: auto;
            margin: 0 auto; padding: 15mm; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Header */
        .header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #6B5B4F;
        }
        
        .company-brand { display: flex; align-items: center; gap: 10px; }
        .company-logo { width: 40px; height: 40px; object-fit: contain; }
        .company-title h1 { font-size: 16px; font-weight: 700; color: #4A3F35; margin-bottom: 2px; }
        .company-title p { font-size: 10px; color: #6B5B4F; }
        
        .badge-kwitansi {
            background: #6B5B4F; color: white; padding: 8px 15px;
            border-radius: 4px; text-align: center;
        }
        .badge-kwitansi .label { font-size: 9px; font-weight: 500; text-transform: uppercase; display: block; }
        .badge-kwitansi .number { font-size: 12px; font-weight: 700; display: block; }
        
        /* Company Info */
        .company-info {
            display: grid; grid-template-columns: 1fr 1fr; gap: 15px;
            margin-bottom: 15px; padding: 10px; background: #F5F0E8;
            border-radius: 4px; font-size: 10px; color: #6B5B4F;
        }
        .info-group .label { font-weight: 600; color: #4A3F35; margin-bottom: 3px; }
        
        /* Payment Info */
        .payment-section { margin-bottom: 12px; }
        .payment-row {
            display: grid; grid-template-columns: 1fr 1.5fr; gap: 15px;
            margin-bottom: 10px;
        }
        .payment-field .label { font-size: 9px; font-weight: 600; color: #4A3F35; text-transform: uppercase; margin-bottom: 3px; }
        .payment-field .value { font-size: 11px; color: #6B5B4F; }
        .payment-field .customer-name { font-weight: 700; color: #4A3F35; font-size: 13px; }
        
        /* Services */
        .services-section { margin-bottom: 15px; }
        .services-header {
            font-size: 10px; font-weight: 600; color: #4A3F35;
            text-transform: uppercase; margin-bottom: 8px;
            padding-bottom: 5px; border-bottom: 2px solid #6B5B4F;
        }
        .service-list { display: flex; flex-direction: column; gap: 8px; }
        .service-card {
            background: #F5F0E8; border-left: 3px solid #6B5B4F;
            padding: 8px 10px; border-radius: 0 4px 4px 0;
        }
        .service-name { font-weight: 700; color: #4A3F35; font-size: 11px; margin-bottom: 4px; }
        .service-details { font-size: 10px; color: #6B5B4F; line-height: 1.5; }
        .detail-row { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 2px; }
        .service-price {
            font-weight: 700; color: #4A3F35; font-size: 11px;
            text-align: right; margin-top: 5px; padding-top: 5px;
            border-top: 1px dashed #D4C8B8;
        }
        .service-note { font-size: 9px; color: #6B5B4F; font-style: italic; margin-top: 3px; }
        
        /* Total */
        .total-section { display: flex; justify-content: flex-end; margin-bottom: 20px; }
        .total-box {
            background: linear-gradient(135deg, #F5F0E8 0%, #fff 100%);
            border: 2px solid #6B5B4F; padding: 10px 20px;
            border-radius: 4px; min-width: 200px;
        }
        .total-row { display: flex; justify-content: space-between; align-items: center; }
        .total-label { font-size: 12px; font-weight: 700; color: #4A3F35; }
        .total-value { font-size: 14px; font-weight: 700; color: #4A3F35; }
        
        /* Signature */
        .signature-section { margin-top: 25px; text-align: right; }
        .signature-box { display: inline-block; text-align: center; width: 150px; }
        .signature-date { font-size: 10px; color: #6B5B4F; margin-bottom: 30px; }
        .signature-line { border-top: 1px solid #6B5B4F; padding-top: 5px; }
        .signature-name { font-weight: 700; color: #4A3F35; font-size: 11px; }
        .signature-title { font-size: 9px; color: #6B5B4F; }
        
        /* Print */
        @media print {
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            body { background: white !important; padding: 0 !important; }
            .print-btn-container { display: none !important; }
            .kwitansi-paper { box-shadow: none !important; width: 100% !important; padding: 0 !important; }
            
            .badge-kwitansi { background: #6B5B4F !important; }
            .company-info, .service-card { background: #F5F0E8 !important; }
            .total-box { background: linear-gradient(135deg, #F5F0E8 0%, #fff 100%) !important; border: 2px solid #6B5B4F !important; }
            .service-card { border-left: 3px solid #6B5B4F !important; }
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
                Cetak Kwitansi
            </button>
        </div>

        <div class="kwitansi-paper">
            <!-- Header -->
            <div class="header">
                <div class="company-brand">
                    <img src="{{ asset('img/b1g.png') }}" alt="Logo" class="company-logo">
                    <div class="company-title">
                        <h1>Teras Bumi Tour</h1>
                        <p>Travel Agent Profesional</p>
                    </div>
                </div>
                <div class="badge-kwitansi">
                    <span class="label">Kwitansi</span>
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

            <!-- Payment Info -->
            <div class="payment-section">
                <div class="payment-row">
                    <div class="payment-field">
                        <div class="label">Tanggal</div>
                        <div class="value">{{ ($order->invoice_date ?? $order->created_at)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="payment-field">
                        <div class="label">Telah Terima Dari</div>
                        <div class="customer-name">{{ $order->customer_name }}</div>
                        <div class="value">{{ $order->customer_phone }}</div>
                    </div>
                </div>

                <!-- Services -->
                <div class="services-section">
                    <div class="services-header">Rincian Pembayaran:</div>
                    <div class="service-list">
                        @foreach($order->items as $index => $item)
                            <div class="service-card">
                                <div class="service-name">{{ $index + 1 }}. {{ ucfirst(str_replace('_', ' ', $item->service_type)) }}</div>
                                
                                @php $data = $item->service_data; @endphp
                                
                                <div class="service-details">
                                    @if($item->service_type === 'tiket_pesawat')
                                        <div class="detail-row">
                                            <span><strong>Maskapai:</strong> {{ $data['maskapai'] ?? '-' }}</span>
                                            <span><strong>Rute:</strong> {{ $data['rute'] ?? '-' }}</span>
                                        </div>
                                        @if(isset($data['nomor_tiket']))
                                            <div><strong>No. Tiket:</strong> {{ $data['nomor_tiket'] }}</div>
                                        @endif
                                        @if(isset($data['nomor_penerbangan']))
                                            <div><strong>No. Penerbangan:</strong> {{ $data['nomor_penerbangan'] }}</div>
                                        @endif
                                        <div class="detail-row">
                                            <span><strong>Tanggal:</strong> {{ isset($data['tanggal_keberangkatan']) ? \Carbon\Carbon::parse($data['tanggal_keberangkatan'])->translatedFormat('d F Y') : '-' }}</span>
                                            <span><strong>Penumpang:</strong> {{ $data['jumlah_penumpang'] ?? '-' }} org</span>
                                        </div>
                                        
                                    @elseif($item->service_type === 'hotel')
                                        <div><strong>Hotel:</strong> {{ $data['nama_hotel'] ?? '-' }}, {{ $data['kota'] ?? '-' }}</div>
                                        <div class="detail-row">
                                            <span><strong>Check-in:</strong> {{ isset($data['check_in']) ? \Carbon\Carbon::parse($data['check_in'])->translatedFormat('d M Y') : '-' }}</span>
                                            <span><strong>Check-out:</strong> {{ isset($data['check_out']) ? \Carbon\Carbon::parse($data['check_out'])->translatedFormat('d M Y') : '-' }}</span>
                                        </div>
                                        <div><strong>{{ $data['jumlah_kamar'] ?? 1 }} kamar</strong> | <strong>{{ $data['jumlah_hari'] ?? 0 }} malam</strong></div>
                                        @if(isset($data['harga_per_malam']))
                                            <div><strong>Harga/malam:</strong> Rp {{ number_format($data['harga_per_malam'], 0, ',', '.') }}</div>
                                        @endif
                                        
                                    @elseif($item->service_type === 'sewa_mobil')
                                        <div><strong>Jenis:</strong> {{ $data['jenis_mobil'] ?? '-' }}</div>
                                        <div class="detail-row">
                                            <span><strong>Durasi:</strong> {{ $data['durasi_sewa'] ?? '-' }}</span>
                                            <span><strong>{{ ($data['dengan_sopir'] ?? false) ? 'Dengan Sopir' : 'Lepas Kunci' }}</strong></span>
                                        </div>
                                        
                                    @elseif($item->service_type === 'taksi')
                                        <div><strong>Rute:</strong> {{ $data['rute_perjalanan'] ?? '-' }}</div>
                                        <div><strong>Tanggal:</strong> {{ isset($data['tanggal']) ? \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('d F Y') : '-' }}</div>
                                        
                                    @elseif($item->service_type === 'lainnya')
                                        <div>{{ $data['deskripsi'] ?? '-' }}</div>
                                    @endif
                                </div>
                                
                                <div class="service-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                
                                @if($item->notes)
                                    <div class="service-note"><strong>Catatan:</strong> {{ $item->notes }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="total-section">
                <div class="total-box">
                    <div class="total-row">
                        <span class="total-label">TOTAL</span>
                        <span class="total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Signature -->
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
</body>
</html>

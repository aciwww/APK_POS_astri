<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan #{{ $penjualan->id }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            color: #1a1a1a;
            background-color: #eef1f5;
            margin: 0;
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container Struk */
        .receipt-container {
            width: 320px;
            background-color: #ffffff;
            padding: 24px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            position: relative;
        }

        .receipt-container::before {
            content: "";
            display: block;
            position: absolute;
            top: -6px;
            left: 0;
            right: 0;
            height: 12px;
            background: repeating-linear-gradient(45deg, #eef1f5 0 6px, #ffffff 6px 12px);
            border-radius: 10px 10px 0 0;
        }

        .store-header {
            text-align: center;
            padding-bottom: 12px;
            margin-bottom: 12px;
            border-bottom: 2px dashed #d5d5d5;
        }

        .store-header .store-name {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 4px;
        }

        .store-header .store-address {
            font-size: 11px;
            color: #666;
            line-height: 1.5;
        }

        .meta-info {
            font-size: 12px;
            margin-bottom: 12px;
            line-height: 1.7;
        }

        .meta-info .meta-row {
            display: flex;
            justify-content: space-between;
        }

        .divider {
            border: none;
            border-top: 1px dashed #d5d5d5;
            margin: 10px 0;
        }

        .divider-solid {
            border: none;
            border-top: 2px solid #1a1a1a;
            margin: 10px 0;
        }

        .item-block {
            margin-bottom: 8px;
        }

        .item-name {
            font-weight: bold;
            font-size: 12.5px;
            margin-bottom: 2px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 12.5px;
            padding: 3px 0;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 14px;
            padding-top: 6px;
        }

        .badge-method {
            display: inline-block;
            background-color: #1a1a1a;
            color: #fff;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }

        .item-count {
            text-align: right;
            font-size: 11px;
            color: #666;
            margin-top: 6px;
        }

        .footer-note {
            text-align: center;
            font-size: 11px;
            color: #555;
            line-height: 1.6;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 2px dashed #d5d5d5;
        }

        .footer-note .thanks {
            font-weight: bold;
            font-size: 12px;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        /* Navigasi Tombol */
        .action-buttons {
            width: 320px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px 14px;
            text-decoration: none;
            border-radius: 8px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary {
            background-color: #1C7C54;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        /* CSS Khusus Saat Cetak ke Kertas (Printer Termal) */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff;
                padding: 0;
                display: block;
            }
            .receipt-container {
                box-shadow: none;
                padding: 0;
                width: 100%;
                border-radius: 0;
            }
            .receipt-container::before {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Tombol Navigasi -->
    <div class="action-buttons no-print">
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak Struk
        </button>
    </div>

    <!-- Tampilan Struk -->
    <div class="receipt-container">

        <div class="store-header">
            <span class="store-name">TOKO FASHION</span>
            <div class="store-address">
                JL. Hz.Mustafa<br>
                TASIKMALAYA
            </div>
        </div>

        <div class="meta-info">
            <div class="meta-row">
                <span>Waktu</span>
                <span>{{ $penjualan->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="meta-row">
                <span>Kasir</span>
                <span>{{ strtoupper($penjualan->user->name ?? 'ADMIN') }}</span>
            </div>
            <div class="meta-row">
                <span>No. Transaksi</span>
                <span>#{{ $penjualan->id }}</span>
            </div>
        </div>

        <hr class="divider">

        @foreach($penjualan->itemPenjualan as $item)
            <div class="item-block">
                <div class="item-name">{{ strtoupper($item->produk->nama ?? 'PRODUK') }}</div>
                <div class="item-row">
                    <span>{{ number_format($item->harga_satuan, 0, ',', '.') }} x{{ $item->kuantitas }}</span>
                    <span>{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach

        <hr class="divider-solid">

        <div class="summary-row total">
            <span>TOTAL</span>
            <span>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span><span class="badge-method">{{ strtoupper($penjualan->metode_pembayaran) }}</span></span>
            <span>Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        @if($penjualan->metode_pembayaran === 'CASH')
        <div class="summary-row">
            <span>Kembalian</span>
            <span>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
        </div>
        @endif

        <div class="item-count">
            Jumlah item: {{ $penjualan->itemPenjualan->sum('kuantitas') }}
        </div>

        <div class="footer-note">
            <div class="thanks">TERIMA KASIH ATAS KUNJUNGAN ANDA</div>
            Barang yang sudah dibeli tidak<br>
            dapat dikembalikan
        </div>

    </div>

</body>
</html>
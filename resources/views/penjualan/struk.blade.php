<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $sale->id }}</title>
    <style>
        /* Reset & Layout Dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #d1d5db;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding: 20px 10px;
        }

        /* BENTUK KERTAS STRUK THERMAL */
        .paper-receipt {
            background: #ffffff;
            width: 300px; /* Lebar standar kertas thermal 80mm */
            padding: 20px 15px 30px 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        /* Efek Gerigi Potongan Kertas Thermal (Atas & Bawah) */
        .paper-receipt::before,
        .paper-receipt::after {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 10px;
            background-size: 15px 10px;
        }

        .paper-receipt::before {
            top: -10px;
            background-image: radial-gradient(circle, transparent 70%, #ffffff 75%);
        }

        .paper-receipt::after {
            bottom: -10px;
            background-image: radial-gradient(circle, #ffffff 70%, transparent 75%);
        }

        /* HEADER & FOOTER */
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        
        .store-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .store-address {
            font-size: 11px;
            margin-bottom: 10px;
        }

        /* GARIS PUTUS-PUTUS KASIR */
        .divider {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
        }

        .item-row td {
            padding-top: 4px;
        }

        /* TOMBOL CETAK */
        .action-buttons {
            margin-top: 25px;
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-print {
            background-color: #16a34a;
            color: #fff;
            border: none;
            padding: 10px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 14px;
        }

        .btn-print:hover {
            background-color: #15803d;
        }

        .btn-back {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            font-family: sans-serif;
            font-size: 13px;
        }

        /* ATURAN SAAT DICETAK/PRINT */
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .paper-receipt {
                box-shadow: none;
                width: 100%;
                padding: 0;
            }
            .paper-receipt::before,
            .paper-receipt::after,
            .action-buttons {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- KERTAS STRUK -->
    <div class="paper-receipt">
        
        <!-- HEADER TOKO -->
        <div class="text-center">
            <div class="store-title">TOKO FASHION</div>
            <div class="store-address">
                Jl. Contoh Alamat No. 123<br>
                Telp: 0812-3456-7890
            </div>
        </div>

        <div class="divider"></div>

        <!-- INFO TRANSAKSI -->
        <table>
            <tr>
                <td>Tanggal</td>
                <td class="text-end">{{ $sale->created_at ? $sale->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>No. Transaksi</td>
                <td class="text-end">#{{ $sale->id }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-end">{{ $sale->user->name ?? 'Kasir' }}</td>
            </tr>
            <tr>
                <td>Metode Bayar</td>
                <td class="text-end fw-bold">{{ $sale->metode_pembayaran }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- LIST PRODUK -->
        <table>
            @foreach($sale->itemPenjualan as $item)
            <tr class="item-row">
                <td colspan="2" class="fw-bold">{{ $item->produk->nama }}</td>
            </tr>
            <tr>
                <td>{{ $item->kuantitas }} x {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                <td class="text-end">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="divider"></div>

        <!-- TOTAL & PEMBAYARAN -->
        <table>
            <tr class="fw-bold">
                <td>TOTAL</td>
                <td class="text-end">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>BAYAR</td>
                <td class="text-end">Rp {{ number_format($sale->uang_dibayar ?? $sale->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>KEMBALI</td>
                <td class="text-end">Rp {{ number_format($sale->kembalian ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- FOOTER -->
        <div class="text-center" style="margin-top: 10px;">
            Terima kasih telah berbelanja!<br>
            --- Barang yang sudah dibeli ---<br>
            tidak dapat ditukarkan kembali
        </div>

    </div>

    <!-- TOMBOL AKSI -->
    <div class="action-buttons">
        <button onclick="window.print()" class="btn-print">Cetak Struk</button>
    </div>

</body>
</html>
@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

@include('layouts.navbar')

<style>
    /* Styling Kertas Thermal Struk */
    .paper-receipt {
        background: #ffffff;
        width: 100%;
        max-width: 300px;
        padding: 20px 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        position: relative;
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        color: #000;
        border-radius: 4px;
        margin: 0 auto;
    }

    .paper-receipt .text-center { text-align: center; }
    .paper-receipt .text-end { text-align: right; }
    .paper-receipt .fw-bold { font-weight: bold; }

    .paper-receipt .store-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 3px;
        text-transform: uppercase;
    }

    .paper-receipt .store-address {
        font-size: 11px;
        margin-bottom: 10px;
    }

    .paper-receipt .divider {
        border-bottom: 1px dashed #000;
        margin: 8px 0;
    }

    .paper-receipt table {
        width: 100%;
        border-collapse: collapse;
    }

    .paper-receipt td {
        padding: 2px 0;
        vertical-align: top;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printableReceipt, #printableReceipt * {
            visibility: visible;
        }
        #printableReceipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
        }
    }
</style>

<div class="container my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Detail Transaksi #{{ $penjualan->id }}</h1>
            <p class="text-muted mb-0 small">
                {{ $penjualan->created_at ? $penjualan->created_at->translatedFormat('d F Y, H:i') : '-' }}
            </p>
        </div>
        <div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- Informassi Transaksi -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-secondary text-uppercase small mb-3">Informasi Transaksi</h6>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Kasir</p>
                        <p class="fw-semibold mb-0">{{ $penjualan->user->name ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Status</p>
                        @if($penjualan->status === 'COMPLETED')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">Selesai</span>
                        @elseif($penjualan->status === 'OPEN')
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-medium">Belum Selesai</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill fw-medium">{{ $penjualan->status }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">Metode Pembayaran</p>
                        <p class="fw-semibold mb-0">
                            {{ $penjualan->metode_pembayaran ?? '-' }}
                        </p>
                    </div>

                    @if($penjualan->metode_pembayaran === 'QRIS')
                    <div class="mb-3 text-center">
                        <div id="qrcode_detail" class="d-flex justify-content-center my-2"></div>
                        <small class="text-muted">Dibayar via QRIS</small>
                    </div>
                    @endif

                    <hr class="text-muted opacity-25">

                    <div>
                        <p class="text-muted small mb-1">Total Pembayaran</p>
                        <h3 class="fw-bold text-success mb-0">
                            Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                        </h3>
                    </div>

                    @if($penjualan->metode_pembayaran === 'CASH' && !is_null($penjualan->uang_dibayar))
                        <hr class="text-muted opacity-25">

                        <div class="mb-2">
                            <p class="text-muted small mb-1">Uang Diberikan</p>
                            <p class="fw-semibold mb-0">
                                Rp {{ number_format($penjualan->uang_dibayar, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-muted small mb-1">Kembalian</p>
                            <p class="fw-bold text-success mb-0">
                                Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Item -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h6 class="fw-bold text-secondary text-uppercase small mb-0">Item Dibeli</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th class="ps-4" style="width: 5%;">#</th>
                                <th style="width: 35%;">Produk</th>
                                <th style="width: 15%;">Jenis</th>
                                <th class="text-center" style="width: 10%;">Qty</th>
                                <th class="text-end" style="width: 15%;">Harga Satuan</th>
                                <th class="text-end pe-4" style="width: 20%;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan->itemPenjualan as $item)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">
                                    {{ $item->produk->nama ?? 'Produk telah dihapus' }}
                                </td>
                                <td class="text-secondary small">
                                    {{ $item->produk->jenis->nama_jenis ?? '-' }}
                                </td>
                                <td class="text-center">{{ $item->kuantitas }}</td>
                                <td class="text-end text-muted">
                                    Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td class="text-end pe-4 fw-semibold">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Tidak ada item dalam transaksi ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="5" class="text-end fw-bold ps-4">Total</td>
                                <td class="text-end pe-4 fw-bold text-success">
                                    Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="card-footer bg-white border-top py-3 px-4 text-end">
                    <!-- Tombol ini yang memicu munculnya Pop-Up Modal Struk -->
                    <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalStruk">
                        <i class="bi bi-receipt"></i>
                        <span>Lihat & Cetak Struk</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- MODAL POPUP STRUK DI TENGAH LAYAR -->
<div class="modal fade" id="modalStruk" tabindex="-1" aria-labelledby="modalStrukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body p-0 d-flex flex-column align-items-center">

                <div class="paper-receipt" id="printableReceipt">
                    <div class="text-center">
                        <div class="store-title">TOKO FASHION</div>
                        <div class="store-address">
                            Jl. Contoh Alamat No. 123<br>
                            Telp: 0812-3456-7890
                        </div>
                    </div>

                    <div class="divider"></div>

                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td class="text-end">{{ $penjualan->created_at ? $penjualan->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>No. Transaksi</td>
                            <td class="text-end">#{{ $penjualan->id }}</td>
                        </tr>
                        <tr>
                            <td>Kasir</td>
                            <td class="text-end">{{ $penjualan->user->name ?? 'Kasir' }}</td>
                        </tr>
                        <tr>
                            <td>Metode Bayar</td>
                            <td class="text-end fw-bold">{{ $penjualan->metode_pembayaran }}</td>
                        </tr>
                    </table>

                    <div class="divider"></div>

                    <table>
                        @foreach($penjualan->itemPenjualan as $item)
                        <tr class="item-row">
                            <td colspan="2" class="fw-bold">{{ $item->produk->nama ?? 'Produk' }}</td>
                        </tr>
                        <tr>
                            <td>{{ $item->kuantitas }} x {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="divider"></div>

                    <table>
                        <tr class="fw-bold">
                            <td>TOTAL</td>
                            <td class="text-end">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>BAYAR</td>
                            <td class="text-end">Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>KEMBALI</td>
                            <td class="text-end">Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>

                    <div class="divider"></div>

                    <div class="text-center" style="margin-top: 10px;">
                        Terima kasih telah berbelanja!<br>
                        --- Barang yang sudah dibeli ---<br>
                        tidak dapat ditukarkan kembali
                    </div>
                </div>

                <div class="w-100 mt-3 d-flex gap-2">
                    <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success w-50" onclick="printReceipt()">Cetak</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function printReceipt() {
        window.print();
    }
</script>

@if($penjualan->metode_pembayaran === 'QRIS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new QRCode(document.getElementById('qrcode_detail'), {
            text: `QRIS-DEMO|Transaksi:{{ $penjualan->id }}|Total:Rp{{ $penjualan->total_pembayaran }}`,
            width: 150,
            height: 150
        });
    });
</script>
@endif

@endsection
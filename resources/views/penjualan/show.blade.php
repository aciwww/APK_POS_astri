@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

@include('layouts.navbar')

<style>
    .card-receipt {
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #e0e0e0;
    }
    .badge-status {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }
    .table-detail td, .table-detail th {
        vertical-align: middle;
    }
</style>

<h4 class="mb-3 text-center">Detail Transaksi #{{ $penjualan->id }}</h4>

<div class="card card-receipt shadow-sm">
    <div class="card-body">

        {{-- ================= INFO TRANSAKSI ================= --}}
        <div class="d-flex justify-content-between mb-3">
            <div>
                <div class="text-muted small">Kasir</div>
                <div class="fw-semibold">{{ $penjualan->user->name ?? '-' }}</div>
            </div>
            <div class="text-end">
                <div class="text-muted small">Tanggal</div>
                <div class="fw-semibold">{{ $penjualan->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div>
                <div class="text-muted small">Metode Pembayaran</div>
                <div class="fw-semibold">{{ $penjualan->metode_pembayaran ?? '-' }}</div>
            </div>
            <div class="text-end">
                <div class="text-muted small">Status</div>
                <span class="badge badge-status {{ $penjualan->status === 'COMPLETED' ? 'bg-success' : 'bg-warning' }}">
                    {{ $penjualan->status }}
                </span>
            </div>
        </div>

        <hr>

        {{-- ================= DAFTAR ITEM ================= --}}
        <table class="table table-borderless table-detail mb-2">
            <thead>
                <tr class="border-bottom">
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama ?? 'Produk dihapus' }}</td>
                    <td class="text-center">{{ $item->kuantitas }}</td>
                    <td class="text-end">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada item</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <hr>

        {{-- ================= RINGKASAN PEMBAYARAN ================= --}}
        <div class="d-flex justify-content-between mb-1">
            <span class="text-muted">Total Belanja</span>
            <span class="fw-semibold">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>

        @if($penjualan->metode_pembayaran === 'CASH')
        <div class="d-flex justify-content-between mb-1">
            <span class="text-muted">Uang Dibayar</span>
            <span>Rp {{ number_format($penjualan->uang_dibayar, 0, ',', '.') }}</span>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <span class="text-muted">Kembalian</span>
            <span>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
        </div>
        @else
        <div class="d-flex justify-content-between mb-1">
            <span class="text-muted">Dibayar via</span>
            <span>QRIS</span>
        </div>
        @endif

        <hr>

        <div class="d-flex justify-content-between">
            <span class="fw-bold fs-5">Total</span>
            <span class="fw-bold fs-5 text-success">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between bg-white">
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">
            &larr; Kembali
        </a>
        <a href="{{ route('penjualan.print', $penjualan->id) }}" class="btn btn-primary">
            Cetak Struk
        </a>
    </div>
</div>

@endsection
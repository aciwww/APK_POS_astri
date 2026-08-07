@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(160deg, #E1F5EE 0%, #F7F5EE 45%, #E6F1FB 100%);
        background-attachment: fixed;
        min-height: 100vh;
    }

    .btn-primary {
        background-color: #1C7C54;
        border-color: #1C7C54;
    }
    .btn-primary:hover {
        background-color: #125439;
        border-color: #125439;
    }

    .btn-outline-secondary {
        color: #1C7C54;
        border-color: #1C7C54;
    }
    .btn-outline-secondary:hover {
        background-color: #1C7C54;
        border-color: #1C7C54;
        color: #fff;
    }

    .btn-warning {
        background-color: #E8A33D;
        border-color: #E8A33D;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #b87a22;
        border-color: #b87a22;
        color: #fff;
    }

    .btn-danger {
        background-color: #E24B4A;
        border-color: #E24B4A;
    }
    .btn-danger:hover {
        background-color: #b73534;
        border-color: #b73534;
    }

    .table thead th {
        background-color: #F7F5EE;
    }
    .table tbody tr:hover {
        background-color: #E1F5EE;
    }
</style>

<div class="container">
    <h1 class="mb-4">Detail Penjualan</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informasi Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Tanggal Transaksi</div>
                <div class="col-md-9">: {{ $penjualan->created_at->format('d-m-Y H:i:s') }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Kasir</div>
                <div class="col-md-9">: {{ $penjualan->user->name }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Metode Pembayaran</div>
                <div class="col-md-9">: {{ $penjualan->metode_pembayaran }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 fw-bold">Status</div>
                <div class="col-md-9">:
                    <span class="badge bg-{{ $penjualan->status == 'OPEN' ? 'warning' : 'success' }}">
                        {{ $penjualan->status }}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 fw-bold">Total Pembayaran</div>
                <div class="col-md-9">: Rp {{ number_format($penjualan->total_pembayaran) }}</div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Daftar Produk</h5>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualan->itemPenjualan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp {{ number_format($item->subtotal / $item->kuantitas) }}</td>
                        <td>{{ $item->kuantitas }}</td>
                        <td>Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    

    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
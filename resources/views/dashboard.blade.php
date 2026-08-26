@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    :root {
        --ink: #20241F;
        --muted: #6B6F67;
        --border: #E4E1D8;
        --mint: #E1F5EE;
        --mint-text: #125439;
        --green: #1C7C54;
    }

    body {
        background: linear-gradient(160deg, #E1F5EE 0%, #F7F5EE 45%, #E6F1FB 100%);
        background-attachment: fixed;
        min-height: 100vh;
    }

    .section-title { text-align: center; font-weight: 700; color: #20241F; margin: 40px 0 20px; }
    .section-title .date { color:  #6B6F67; font-weight: 500; }

    .stat-card { background: #fff; border: 1px solid #E4E1D8; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 24px -14px rgba(28,124,84,0.25); }
    .stat-card .stat-label { background: #E1F5EE; color: #125439; font-size: .85rem; font-weight: 500; text-align: center; padding: 12px; }
    .stat-card .stat-value { text-align: center; padding: 20px; font-size: 1.4rem; font-weight: 700; color: #20241F; }

    .table-pos { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 24px -16px rgba(0,0,0,0.15); }
    .table-pos thead th { background: #F7F5EE; color: #20241F; font-weight: 600; padding: 12px 16px; text-align: left; border-bottom: 1px solid #E4E1D8; }
    .table-pos tbody td { padding: 12px 16px; border-bottom: 1px solid #E4E1D8; color: #20241F; }
    .table-pos tbody tr:last-child td { border-bottom: none; }
    .table-pos tbody tr:hover { background: #E1F5EE; }

    .badge-stock-low { background: #FCEFD9; color: #8a5a12; padding: 3px 10px; border-radius: 20px; font-size: .8rem; font-weight: 600; }
    .badge-stock-out { background: #FBE4E3; color: #a12a29; padding: 3px 10px; border-radius: 20px; font-size: .8rem; font-weight: 600; }
    .badge-stock-safe { background: #E1F5EE; color: #125439; padding: 3px 10px; border-radius: 20px; font-size: .8rem; font-weight: 600; }
    .empty-note { text-align: center; color: #6B6F67; font-style: italic; padding: 18px; }

    /* ====== perbaikan: kotak kartu statistik & tabel dirapikan, warna abu diganti mint ====== */

    .card {
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 24px -14px rgba(28,124,84,0.20);
        margin-bottom: 16px;
    }

    .card-header {
        background: var(--mint);
        color: var(--mint-text);
        border-bottom: 1px solid var(--border);
        padding: 12px;
    }

    .card-body { padding: 20px; }

    .card-title { font-size: 1.4rem; font-weight: 700; color: var(--ink); margin: 0; }

    .table {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 24px -16px rgba(0,0,0,0.12);
    }

    .table thead th { background: var(--mint); color: var(--mint-text); font-weight: 600; padding: 12px 16px; text-align: left; border-bottom: 1px solid var(--border); }
    .table tbody td { padding: 12px 16px; border-bottom: 1px solid var(--border); color: var(--ink); vertical-align: middle; }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr:hover { background: var(--mint); }

    .text-muted.text-center { color: var(--muted) !important; }

    .pagination .page-link { color: var(--green); border-color: var(--border); }
    .pagination .page-item.active .page-link { background: var(--green); border-color: var(--green); }
</style>

@include('layouts.navbar')

<div class="text-center">
  <h1>
    Ringkasan Hari Ini
    <small class="text-muted">
      ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
    </small>
  </h1>
</div>

{{-- ================= SALES (ADMIN ONLY) ================= --}}
@can('viewAny', App\Models\User::class)
<div class="row">

  <div class="col-md-12 text-center">
    <h1>Today's Sales</h1>
  </div>

  <div class="col-md-6 text-center">
    <div class="card">
      <div class="card-header">
        Total Nilai Penjualan Hari ini
      </div>
      <div class="card-body">
        <h5 class="card-title">
          Rp {{ number_format($ringkasan['total_penjualan']) }}
        </h5>
      </div>
    </div>
  </div>

  <div class="col-md-6 text-center">
    <div class="card">
      <div class="card-header">
        Jumlah Transaksi Hari ini
      </div>
      <div class="card-body">
        <h5 class="card-title">
          {{ number_format($ringkasan['total_transaksi']) }}
        </h5>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-12 text-center">
    <h1>Cash & Payment Status</h1>
  </div>

  <div class="col-md-6 text-center">
    <div class="card">
      <div class="card-header">
        Total pembayaran tunai
      </div>
      <div class="card-body">
        <h5 class="card-title">
          Rp {{ number_format($ringkasan['total_cash']) }}
        </h5>
      </div>
    </div>
  </div>

  <div class="col-md-6 text-center">
    <div class="card">
      <div class="card-header">
        Total pembayaran non-tunai
      </div>
      <div class="card-body">
        <h5 class="card-title">
          Rp {{ number_format($ringkasan['total_non_tunai']) }}
        </h5>
      </div>
    </div>
  </div>

</div>
@endcan


{{-- ================= INVENTORY ================= --}}
<div class="row">

  <div class="col-md-12 text-center">
    <h1>Critical Inventory Status</h1>
  </div>

  {{-- Stok Rendah --}}
  <div class="col-md-6 text-center">
    <h3>Daftar produk stok rendah</h3>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Stok</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($produkStokRendah as $index => $produk)
        <tr>
          <td>{{ $produkStokRendah->firstItem() + $index }}</td>
          <td>{{ $produk->nama }}</td>
          <td>{{ $produk->stok }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-muted text-center">
            seluruh produk berada dalam kondisi stok aman.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>

    {{ $produkStokRendah->links() }}
  </div>

  {{-- Stok Habis --}}
  <div class="col-md-6 text-center">
    <h3>Produk habis stok</h3>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Stok</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($produkStokRendah as $index => $produk)
        <tr>
          <td>{{ $produkStokRendah->firstItem() + $index }}</td>
          <td>{{ $produk->nama }}</td>
          <td>{{ $produk->stok }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-muted text-center">
            seluruh produk berada dalam kondisi stok aman.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>

    {{ $produkStokRendah->links() }}
  </div>

</div>


{{-- ================= BEST SELLER ================= --}}
<div class="row">

  <div class="col-md-12 text-center"
    <h1>Best Seller Products</h1>
  </div>

  <div class="col-md-12 text-center">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Stok</th>
          <th>Unit Terjual</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($produkTerlaris as $produk)
        <tr>
          <td>{{ $produk->nama }}</td>
          <td>{{ $produk->stok }}</td>
          <td>{{ $produk->total_terjual }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-muted text-center">
            seluruh produk berada dalam kondisi stok aman.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

@endsection
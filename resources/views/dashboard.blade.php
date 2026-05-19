@extends('layouts.app')

@section('title', 'Login')

@section('content')

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

  <div class="col-md-12 text-center">
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
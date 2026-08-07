@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')


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

@if(session('errors'))
        <div class="alert alert-danger">
          {{ session('errors')}}
        </div>
    @endif

<div class="container m-3"></div>
<h2>Penjualan</h2>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Search penjualan">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tanggal Transaksi</th>
      <th scope="col">Kasir</th>
      <th scope="col">Total Pembayaran</th>
      <th scope="col">Metode Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($sales as $sale)
    <tr>
      <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
      <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
      <td>{{ $sale->user->name }}</td>
      <td>Rp.{{ number_format($sale->total_pembayaran) }}</td>
      <td>{{ $sale->metode_pembayaran }}</td>
      <td>{{ $sale->status }}</td>
      <td class="gap-1">
        <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-primary">Detail</a>
        @can('view', $sale)
        ||
        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning">Edit</a>
        @endcan
        @can('delete', $sale)
        ||
        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
              Hapus
            </button>
        </form>
        @endcan
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="7">Data Tidak Ditemukan</td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $sales->links() }}
@endsection
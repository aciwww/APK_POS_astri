@extends('layouts.app')

@section('title', 'Produk')

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

<div class="container m-3"></div>
<h2>Produk</h2>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">create</a>
@endcan 

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value=""
            class="form-control"
            placeholder="Search nama produk">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>    
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
   @forelse ($products as $product)
    <tr>
        <th scope="row">
            {{ $products->firstItem() + $loop->index }}
        </th>
    <td>{{ $product->user->name }}</td>
    <td>
        <img src="{{ asset('storage/'.$product->foto) }}"
                width="100"
                class="img-thumbnail">
    </td>
    <td>{{ $product->nama }}</td>
    <td>{{ $product->harga_beli }}</td>
    <td>{{ $product->harga_jual }}</td>
    <td>{{ $product->stok }}</td>
    <td class=" gap-1">
        @can('update', $product)
        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
        @endcan
        ||
        @can('delete', $product)
        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
            @csrf 
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
                Hapus
            </button>
        </form>    
        @endcan
    </td>
  </tr>
    @empty
        <tr>
            <td collspan=8><h1>Data tidak tersedia.</h1></td>
        </tr>
    @endforelse   
  </tbody>
</table>
{{ $products->links() }}
@endsection
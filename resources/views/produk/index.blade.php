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

    /* Style Card E-Commerce */
    .product-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background-color: #ffffff;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
    .product-img-wrapper {
        height: 180px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .product-img {
        max-height: 100%;
        width: 100%;
        object-fit: cover;
    }
</style>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
        @endcan 
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search nama produk">

            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>    
        </div>
    </form>

    <!-- Grid Card Produk -->
    <div class="row g-3">
        @forelse ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100 shadow-sm">
                <!-- Wrapper Gambar & Badge Stok -->
                <div class="product-img-wrapper position-relative">
                    @if($product->foto)
                        <img src="{{ asset('storage/'.$product->foto) }}" class="product-img" alt="{{ $product->nama }}">
                    @else
                        <span class="text-muted small">No Image</span>
                    @endif

                    <!-- Badge Stok -->
                    <span class="badge bg-secondary position-absolute top-0 end-0 m-2">
                        Stok: {{ $product->stok }}
                    </span>
                </div>

                <!-- Body Card -->
                <div class="card-body d-flex flex-column p-3">
                    <span class="text-muted mb-1" style="font-size: 0.75rem;">Oleh: {{ $product->user->name ?? '-' }}</span>
                    
                    <!-- 1. Nama Produk -->
                    <h6 class="card-title fw-bold text-truncate mb-0" title="{{ $product->nama }}">{{ $product->nama }}</h6>
                    
                    <!-- 2. Nama Jenis (di bawah nama produk) -->
                    <small class="fw-semibold mb-2" style="font-size: 0.8rem;">
                        {{ $product->jenis->nama_jenis ?? 'Tanpa Jenis' }}
                    </small>
                    
                    <div class="mt-auto">
                        <!-- Detail Harga -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">Beli: Rp{{ number_format($product->harga_beli, 0, ',', '.') }}</span>
                            <span class="fw-bold text-dark">Rp{{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 border-top pt-2">
                            @can('update', $product)
                            <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm w-50">Edit</a>
                            @endcan
                            
                            @can('delete', $product)
                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="w-50">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>    
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">Data produk tidak tersedia.</h5>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
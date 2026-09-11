@extends('layouts.app')

@section('title', 'POS')

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
            {{ session('errors') }}
        </div>
    @endif    

<h4 class="mb-3">
    Tambah dan Edit
</h4>

<div class="row">

{{-- ================== PRODUK ================== --}}
<div class="col-md-6">
    <div class="card">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3">
                <form method="GET" action="{{ route('penjualan.create') }}">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari produk..."
                        onkeyup="this.form.submit()">
                </form>
            </div>
            @foreach($products as $product)
            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                @csrf 
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-7">
                    <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        <div class="d-flex align-items-center gap-2">

                        {{-- Gambar produk --}}
                        <img src="{{ asset('storage/'.$product->foto) }}"
                            alt="Gambar"
                            class="rounded-circle"
                            style="width:45px; height:45px; object-fit:cover;">

                        {{-- Nama & harga --}}
                        <div>
                            <div class="fw-semibold">{{ $product->nama }}</div>
                            <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                        </div>    

                        </div>
                    </button>
                </div>

                <div class="col-3">
                    <input type="number" name="quantity" value="1" min="1"
                            class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                </div>

                <div class="col-2">
                    <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                </div>
            </form>
          @endforeach  
    </div>

</div>
</div>

{{-- ================== KERANJANG ================= --}}
<div class="col-md-6">
    <div class="card">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
                    <td>
                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                            @csrf @method('PUT')
                            <input type="number" name="quantity"
                                    value="{{ $item->kuantitas }}"
                                    class="form-control form-control-sm">
                        </form>
                    </td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                    <td>
                        @can('delete', $item)
                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        keranjang kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="card-footer">
            <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return validasiBayar()" class="mt-2">
            @csrf 
            @method('PUT')

            {{-- Tambahkan id="paymentMethod" dan event onchange --}}
            <select name="payment_method" id="paymentMethod" class="form-select mb-2" onchange="toggleCashSection()">
                <option value="">Pilih Pembayaran</option>
                <option value="CASH">Cash</option>
                <option value="QRIS">QRIS</option>
            </select>

            {{-- Bungkus input uang & kembalian dalam div #sectionCash dan beri style="display: none;" --}}
            <div id="sectionCash" style="display: none;">
                <div class="mb-2">
                    <label class="fw-semibold small">Uang Dibayar</label>
                    <input type="number" name="uang_dibayar" id="uangDibayar"
                        class="form-control" placeholder="Masukkan jumlah uang"
                        oninput="hitungKembalian()">
                </div>

                <div class="mb-2">
                    <label class="fw-semibold small">Kembalian</label>
                    <input type="text" id="kembalianTampil" class="form-control" readonly value="Rp 0">
                </div>
            </div>

            <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                Checkout
            </button>
        </form>
            @can('delete', $sale)
            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                    @csrf 
                    @method('DELETE')
                    <button class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Batal Transaksi
                    </button>
                </form>
                @endcan
        </div>
    </div>
</div>

</div>

{{-- ===== TAMBAHAN: Script hitung kembalian & validasi sebelum submit ===== --}}
<script>
    const totalBelanja = {{ $sale->total_pembayaran }};

    // Fungsi untuk menampilkan/menyembunyikan input Cash
    function toggleCashSection() {
        let metode = document.getElementById('paymentMethod').value;
        let sectionCash = document.getElementById('sectionCash');
        let inputUang = document.getElementById('uangDibayar');

        if (metode === 'CASH') {
            sectionCash.style.display = 'block'; // Tampilkan input jika CASH
            inputUang.value = '';
            document.getElementById('kembalianTampil').value = 'Rp 0';
        } else {
            sectionCash.style.display = 'none';  // Sembunyikan jika QRIS / belum pilih
            // Untuk QRIS, otomatis set nilai uang_dibayar = totalBelanja (uang pas)
            inputUang.value = totalBelanja;
        }
    }

    // Fungsi hitung kembalian
    function hitungKembalian() {
        let dibayar = parseFloat(document.getElementById('uangDibayar').value) || 0;
        let kembali = dibayar - totalBelanja;
        document.getElementById('kembalianTampil').value =
            'Rp ' + (kembali > 0 ? kembali.toLocaleString('id-ID') : 0);
    }

    // Fungsi validasi form saat checkout
    function validasiBayar() {
        let metode = document.getElementById('paymentMethod').value;

        if (!metode) {
            alert('Pilih metode pembayaran terlebih dahulu!');
            return false;
        }

        if (metode === 'CASH') {
            let dibayar = parseFloat(document.getElementById('uangDibayar').value) || 0;
            if (dibayar < totalBelanja) {
                alert('Uang dibayar kurang dari total belanja!');
                return false;
            }
        }

        return confirm('Yakin ingin checkout?');
    }
</script>
{{-- ===== AKHIR TAMBAHAN ===== --}}

@endsection
<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })                                            
            // Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); 
        
        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }
       
        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['user', 'itemPenjualan.produk']);
        $sale = $penjualan;
        
        return view('penjualan.struk', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $sale = $penjualan;

        $request->validate([
            'payment_method' => 'required|string',
            'uang_dibayar'   => 'nullable|numeric|min:0',
        ]);

        // Tentukan jumlah uang dibayar & kembalian
        if ($request->payment_method === 'QRIS') {
            $uangDibayar = $sale->total_pembayaran;
            $kembalian   = 0;
        } else {
            $uangDibayar = $request->uang_dibayar ?? 0;
            
            // Validasi jika uang tunai kurang
            if ($uangDibayar < $sale->total_pembayaran) {
                return back()->with('errors', 'Uang dibayar kurang dari total belanja.');
            }
            
            $kembalian = $uangDibayar - $sale->total_pembayaran;
        }

        $sale->update([
            'metode_pembayaran' => $request->payment_method,
            'status'            => 'COMPLETED',
            'uang_dibayar'      => $uangDibayar,
            'kembalian'         => $kembalian,
        ]);

        // DIPERBAIKI: Dialihkan ke daftar penjualan (bukan langsung ke struk)
        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Tampilkan halaman struk untuk dicetak.
     */
    public function struk(Penjualan $sale)
    {
        $sale->load('itemPenjualan.produk');

        return view('penjualan.struk', compact('sale'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        
        // Pastikan hanya transaksi OPEN
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // kembalikan stok
                $item->produk->increment('stok', $item->kuantitas);
            }

            // hapus item
            $penjualan->itemPenjualan()->delete();

            // hapus penjualan
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException; 

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan =Penjualan::with(['pelanggan', 'user'])
            ->orderByDesc('tgl_penjualan')
            ->orderByDesc('id_penjualan')
            ->paginate(10);

        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();

        $produk = Produk::where('stok', '>', 0)
            ->orderBy('nama_produk')
            ->get(['id_produk', 'kode_produk', 'nama_produk', 'harga_jual', 'stok', 'satuan']);

            return view('penjualan.create', compact('pelanggan', 'produk'));

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan'          => 'nullable|exists:pelanggan,id_pelanggan',
            'items'                 => 'required|array|min:1',
            'items.*.id_produk'     => 'required|exists:produk,id_produk|distinct',
            'items.*.jumlah'        => 'required|integer|min:1',
            'items.*.diskon_item'   => 'nullable|numeric|min:0',
            'diskon'                => 'nullable|numeric|min:0',
            'pembayaran'            => 'required|numeric|min:0',

        ], [
            'items.required'                => 'Tambahkan minimal satu produk.',
            'items.*.id_produk.required'    => 'Ada baris yang produknya belum dipilih.',
            'items.*.id_produk.distinct'    => 'Produk yang sama tidak boleh dipilih dua kali.',

        ]);

        $penjualan = DB::transaction(function () use ($data) {
            $baris = [];
            $totalItem = 0;
            $totalSisaStok = 0;

            foreach ($data['items'] as $item ) {
                $produk = Produk::lockForUpdate()->findOrFail($item['id_produk']);
                $jumlah = (int) $item['jumlah'];
                $diskonItem = (float) ($item['diskon_item'] ?? 0);

                if ($produk->stok < $jumlah ) {
                    throw ValidationException::withMessages([
                        'item' => "Stok {$produk->nama_produk} tidak cukup (sisa{$produk->stok}).",

                    ]);

                }

                $subtotal = ($produk->harga_jual * $jumlah) - $diskonItem;

                if($subtotal < 0) {
                    throw ValidationException::withMessages([
                        'items' => "Diskon item {$produk->nama_produk} melebihi harganya.", 
                    ]);
                }

                $sisa = $produk->stok - $jumlah;
                $produk->update(['stok' => $sisa]);

                $baris[] = [
                    'id_produk' => $produk->id_produk,
                    'harga_jual' => $produk->harga_jual,
                    'jumlah' => $jumlah,
                    'diskon_item' => $diskonItem,
                    'subtotal' => $subtotal,
                    'stok' => $sisa,
                ];

                $totalItem += $subtotal;
                $totalSisaStok += $sisa;
            }

            $diskon = (float) ($data['diskon'] ?? 0);
            $total = $totalItem - $diskon;
            $bayar = (float) $data['pembayaran'];

            if ($total < 0 ) {
                throw ValidationException::withMessages([
                    'diskon' => 'Diskon melebihi total belanja.',

                ]);
            }

            if($bayar < $total) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Pembayaran kurang dari total.',

                ]);
            }

            $urut = Penjualan::whereDate('tgl_penjualan', today())->count() + 1;
            $noNota = 'NTA-' . now()->format('Ymd') . '-' . str_pad($urut, 4, '0', STR_PAD_LEFT);

            $penjualan = Penjualan::create([
                'id_pelanggan'          => $data['id_pelanggan'] ?? null,
                'id_user'               => auth()->id(),
                'no_nota'               => $noNota,
                'tgl_penjualan'         => now(),
                'total'                 => $total,
                'diskon'                => $diskon,
                'pembayaran'            => $bayar,
                'kembalian'             => $bayar - $total,
                'stok_akhir'            => $totalSisaStok,
            ]);

            foreach ($baris as $b) {
                $b['id_penjualan'] = $penjualan->id_penjualan;
                DetailPenjualan::create($b);
            }

            return $penjualan;


        });

        return redirect()->route('penjualan.show', $penjualan)
            ->with('success', 'Transaksi berhasil disimpan');
        
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['detail_penjualan.produk', 'pelanggan', 'user']);

        return view('penjualan.show', compact('penjualan'));
    }

}

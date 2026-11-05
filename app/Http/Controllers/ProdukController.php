<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::with('kategori')
            ->when($request->q, function ($query, $q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama_produk', 'like', "%{$q}%")
                    ->orWhere('kode_produk', 'like', "%{$q}%");
                });
            })
            ->when($request->id_kategori, fn ($query, $id) => $query->where('id_kategori', $id))
            ->orderBy('nama_produk')
            ->paginate(10)
            ->withQueryString();
            
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('produk.index', compact('produk' , 'kategori'));

    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        
        return view('produk.create',compact('kategori'));
    
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Produk::create($data);

        return redirect()->route('produk.index')
              ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Produk $produk)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate($this->rules($produk));

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->detail_penjualan()->exists()) {
            return back()->with('error', 'Produk tidak bisa dihapus karena sudah dipakai di transaksi');
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    private function rules(?Produk $produk = null): array
    {
        return [
            'id_kategori' => 'required|exists:kategori, id_kategori',
            'kode_produk' => [
                'required', 'string', 'max:50',
                Rule::unique('produk', 'kode_produk')->ignore($produk?->id_produk, 'id_produk'),
            ],

            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'nullablez|string',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
            'satuan'      => 'nullable|string|max:30',
            'keterangan'  => 'nullable|string',
        ];
    }
}

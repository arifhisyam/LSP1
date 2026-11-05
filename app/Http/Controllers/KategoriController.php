<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('produk')
            ->orderBy('nama_kategori')
            ->paginate(10);

            return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store (Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($data);

        return Redirect()->route('kategori.index')
            ->with('success', 'kategori berhasil ditambahkan');

    }

    public function edit(Kategori $kategori) 
    {
        return view('kategori.edit', compact('kategori'));    
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => [
                'required', 'string', 'max:100',
                Rule::unique('kategori', 'nama_kategori')
                ->ignore($kategori->id_kategori,'id_kategori'),
            ],
            'keterangan' => 'nullable|string'
        ]);

        $kategori->update($data);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy (Kategori $kategori)
    {
        if ($kategori->produk()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih dipakai oleh produk.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

    

}
<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggan = Pelanggan::query()
            ->when($request->q, function ($query, $q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama_pelanggan', 'like', "%{$q}%")
                      ->orWhere('telepon', 'like', "%{$q}%");
                });
            })

            ->orderBy('nama_pelanggan')
            ->paginate(10)
            ->withQueryString();

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store (Request $request)
    {
        $data = $request->validate($this->rules());

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')
            ->with('succes', 'Pelanggan berhasil ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate($this->rules());

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->penjualan()->exists()) {
            return back()->with('error', 'Pelanggan tidak bisa dihapus karena sudah punya riwayat transaksi.');
        }
        
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');

    }

    private function rules(): array
    {
        return [
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nuallable|email|max:100,'
        ];
    }




}

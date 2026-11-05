@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Produk</h1>
        <a href="{{ route('produk.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    <form method="GET" class="flex gap-2 mb-4">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Cari kode / nama produk"
               class="border rounded px-3 py-2 w-64">
        <select name="id_kategori" class="border rounded px-3 py-2">
            <option value="">Semua kategori</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}" @selected(request('id_kategori') == $k->id_kategori)>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
        <button class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
        @if (request('q') || request('id_kategori'))
            <a href="{{ route('produk.index') }}" class="px-4 py-2 rounded border">Reset</a>
        @endif
    </form>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama Produk</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Harga Beli</th>
                    <th class="p-3">Harga Jual</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $produk->firstItem() + $loop->index }}</td>
                        <td class="p-3">{{ $p->kode_produk }}</td>
                        <td class="p-3">{{ $p->nama_produk }}</td>
                        <td class="p-3">{{ $p->kategori->nama_kategori ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($p->harga_beli, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</td>
                        <td class="p-3">
                            {{ $p->stok }} {{ $p->satuan }}
                            @if ($p->stok <= 5)
                                <span class="ml-1 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">Rendah</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <a href="{{ route('produk.edit', $p) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                                <form method="POST" action="{{ route('produk.destroy', $p) }}"
                                      onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $produk->links() }}</div>
@endsection
@extends('layouts.app')

@section('title', 'content')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Kategori</h1>
        <a href="{{ route('kategori.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3">Keterangan</th>
                    <th class="p-3">Jumlah Produk</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $k)
                    <tr>
                        <td class="p-3">{{ $kategori->firstItem() + $loop->index }}</td>
                        <td class="p-3">{{ $k->nama_kategori }}</td>
                        <td class="p-3">{{ $k->keterangan?? '-' }}</td>
                        <td class="p-3">{{ $k->produk_count }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('kategori.edit', $k) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form method="POST" action="{{ route('kategori.destroy', $k) }}"
                            onsubmit="return confirm('Hapus kategori ini')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </form>
                        </td>
                    </tr>
                    
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada kategori.</td>
                </tr>
                    
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $kategori->links() }}</div>
@endsection
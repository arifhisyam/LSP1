@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    <form method="GET" class="flex gap-2 mb-4">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Cari nama / telepon"
               class="border rounded px-3 py-2 w-64">
        <button class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
        @if (request('q'))
            <a href="{{ route('pelanggan.index') }}" class="px-4 py-2 rounded border">Reset</a>
        @endif
    </form>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Alamat</th>
                    <th class="p-3">Telepon</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $pelanggan->firstItem() + $loop->index }}</td>
                        <td class="p-3">{{ $p->nama_pelanggan }}</td>
                        <td class="p-3">{{ $p->alamat ?? '-' }}</td>
                        <td class="p-3">{{ $p->telepon ?? '-' }}</td>
                        <td class="p-3">{{ $p->email ?? '-' }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <a href="{{ route('pelanggan.edit', $p) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                                <form method="POST" action="{{ route('pelanggan.destroy', $p) }}"
                                      onsubmit="return confirm('Hapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">Belum ada pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pelanggan->links() }}</div>
@endsection
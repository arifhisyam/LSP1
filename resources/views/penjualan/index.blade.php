@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Transaksi Penjualan</h1>
        <a href="{{ route('penjualan.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Transaksi Baru</a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="p-3">No Nota</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Pelanggan</th>
                    <th class="p-3">Kasir</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualan as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->no_nota }}</td>
                        <td class="p-3">{{ $p->tgl_penjualan->format('d/m/Y H:i') }}</td>
                        <td class="p-3">{{ $p->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                        <td class="p-3">{{ $p->user->nama_user ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <a href="{{ route('penjualan.show', $p) }}"
                               class="bg-gray-800 text-white px-3 py-1 rounded text-sm">Nota</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $penjualan->links() }}</div>
@endsection
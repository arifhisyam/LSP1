@extends('layouts.app')

@section('title', 'Nota ' . $penjualan->no_nota)

@section('content')
    <div class="bg-white p-6 rounded-xl shadow max-w-2xl">
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold">NOTA PENJUALAN</h1>
            <p class="text-gray-600">{{ $penjualan->no_nota }}</p>
        </div>

        <div class="text-sm mb-4 space-y-1">
            <p>Tanggal : {{ $penjualan->tgl_penjualan->format('d/m/Y H:i') }}</p>
            <p>Kasir : {{ $penjualan->user->nama_user ?? '-' }}</p>
            <p>Pelanggan : {{ $penjualan->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
        </div>

        <table class="w-full text-left text-sm">
            <thead class="border-y">
                <tr>
                    <th class="py-2">Produk</th>
                    <th class="py-2 text-right">Harga</th>
                    <th class="py-2 text-right">Jml</th>
                    <th class="py-2 text-right">Diskon</th>
                    <th class="py-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->detail_penjualan as $d)
                    <tr class="border-b">
                        <td class="py-2">{{ $d->produk->nama_produk }}</td>
                        <td class="py-2 text-right">{{ number_format($d->harga_jual, 0, ',', '.') }}</td>
                        <td class="py-2 text-right">{{ $d->jumlah }}</td>
                        <td class="py-2 text-right">{{ number_format($d->diskon_item, 0, ',', '.') }}</td>
                        <td class="py-2 text-right">{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 ml-auto max-w-xs space-y-1 text-sm">
            <div class="flex justify-between">
                <span>Total belanja</span>
                <span>Rp {{ number_format($penjualan->detail_penjualan->sum('subtotal'), 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Diskon</span>
                <span>Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-bold border-t pt-1">
                <span>Total bayar</span>
                <span>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pembayaran</span>
                <span>Rp {{ number_format($penjualan->pembayaran, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kembalian</span>
                <span>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="mt-4 flex gap-2 print:hidden">
        <button onclick="window.print()"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cetak Nota</button>
        <a href="{{ route('penjualan.create') }}" class="px-4 py-2 rounded border">Transaksi Baru</a>
        <a href="{{ route('penjualan.index') }}" class="px-4 py-2 rounded border">Daftar Transaksi</a>
    </div>
@endsection
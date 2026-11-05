@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Transaksi Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('penjualan.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        @csrf

        <div>
            <label class="block text-sm mb-1">Pelanggan (opsional)</label>
            <select name="id_pelanggan" class="w-full max-w-sm border rounded px-3 py-2">
                <option value="">Umum</option>
                @foreach ($pelanggan as $pl)
                    <option value="{{ $pl->id_pelanggan }}" @selected(old('id_pelanggan') == $pl->id_pelanggan)>
                        {{ $pl->nama_pelanggan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-sm text-gray-600">
                    <tr>
                        <th class="p-2">Produk</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2">Jumlah</th>
                        <th class="p-2">Diskon Item</th>
                        <th class="p-2">Subtotal</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody id="body-item"></tbody>
            </table>
            <button type="button" id="tambah-baris"
                    class="mt-3 bg-gray-800 text-white px-4 py-2 rounded">+ Tambah Produk</button>
        </div>

        <div class="max-w-sm ml-auto space-y-2">
            <div class="flex justify-between">
                <span>Total belanja</span>
                <span id="txt-total-item">Rp 0</span>
            </div>
            <div class="flex justify-between items-center">
                <span>Diskon</span>
                <input type="number" min="0" step="0.01" name="diskon" id="diskon"
                       value="{{ old('diskon', 0) }}" class="w-36 border rounded px-2 py-1 text-right">
            </div>
            <div class="flex justify-between font-bold text-lg border-t pt-2">
                <span>Total bayar</span>
                <span id="txt-total">Rp 0</span>
            </div>
            <div class="flex justify-between items-center">
                <span>Pembayaran</span>
                <input type="number" min="0" step="0.01" name="pembayaran" id="pembayaran"
                       value="{{ old('pembayaran', 0) }}" class="w-36 border rounded px-2 py-1 text-right">
            </div>
            <div class="flex justify-between">
                <span>Kembalian</span>
                <span id="txt-kembalian">Rp 0</span>
            </div>
        </div>

        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Transaksi</button>
            <a href="{{ route('penjualan.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>

    <script>
        const produk = @json($produk);
        const oldItems = @json(old('items', []));

        const body = document.getElementById('body-item');
        const diskonEl = document.getElementById('diskon');
        const bayarEl = document.getElementById('pembayaran');

        const rupiah = n => 'Rp ' + Math.round(n).toLocaleString('id-ID');
        const esc = s => String(s).replace(/[&<>"']/g, c => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[c]));

        let idx = 0;

        function tambahBaris(data = {}) {
            const i = idx++;
            const opsi = produk.map(p =>
                `<option value="${p.id_produk}" ${data.id_produk == p.id_produk ? 'selected' : ''}>
                    ${esc(p.kode_produk)} - ${esc(p.nama_produk)} (stok ${p.stok})
                </option>`
            ).join('');

            const tr = document.createElement('tr');
            tr.className = 'border-t';
            tr.innerHTML = `
                <td class="p-2">
                    <select name="items[${i}][id_produk]" class="produk w-full border rounded px-2 py-1">
                        <option value="">-- Pilih produk --</option>${opsi}
                    </select>
                </td>
                <td class="p-2 harga">-</td>
                <td class="p-2">
                    <input type="number" min="1" name="items[${i}][jumlah]"
                           value="${data.jumlah ?? 1}" class="jumlah w-20 border rounded px-2 py-1">
                </td>
                <td class="p-2">
                    <input type="number" min="0" step="0.01" name="items[${i}][diskon_item]"
                           value="${data.diskon_item ?? 0}" class="diskon-item w-28 border rounded px-2 py-1">
                </td>
                <td class="p-2 subtotal">Rp 0</td>
                <td class="p-2"><button type="button" class="hapus text-red-600">Hapus</button></td>
            `;
            body.appendChild(tr);
            hitung();
        }

        function hitung() {
            let totalItem = 0;

            body.querySelectorAll('tr').forEach(tr => {
                const p = produk.find(x => x.id_produk == tr.querySelector('.produk').value);
                const jumlah = parseInt(tr.querySelector('.jumlah').value) || 0;
                const diskonItem = parseFloat(tr.querySelector('.diskon-item').value) || 0;
                const harga = p ? parseFloat(p.harga_jual) : 0;
                const subtotal = Math.max(harga * jumlah - diskonItem, 0);

                tr.querySelector('.harga').textContent = p ? rupiah(harga) : '-';
                tr.querySelector('.subtotal').textContent = rupiah(subtotal);
                totalItem += subtotal;
            });

            const diskon = parseFloat(diskonEl.value) || 0;
            const total = Math.max(totalItem - diskon, 0);
            const bayar = parseFloat(bayarEl.value) || 0;

            document.getElementById('txt-total-item').textContent = rupiah(totalItem);
            document.getElementById('txt-total').textContent = rupiah(total);
            document.getElementById('txt-kembalian').textContent = rupiah(Math.max(bayar - total, 0));
        }

        document.getElementById('tambah-baris').addEventListener('click', () => tambahBaris());

        body.addEventListener('input', hitung);
        body.addEventListener('change', hitung);
        body.addEventListener('click', e => {
            if (e.target.classList.contains('hapus')) {
                e.target.closest('tr').remove();
                hitung();
            }
        });

        diskonEl.addEventListener('input', hitung);
        bayarEl.addEventListener('input', hitung);

        // pulihkan isian kalau validasi gagal, kalau tidak mulai dari satu baris kosong
        const lama = Object.values(oldItems);
        if (lama.length) {
            lama.forEach(item => tambahBaris(item));
        } else {
            tambahBaris();
        }
    </script>
@endsection
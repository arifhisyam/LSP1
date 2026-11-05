<div class="space-y-4">
    <div>
        <label class="block text-sm mb-1">Kategori</label>
        <select name="id_kategori" class="w-full border rounded px-3 py-2">
            <option value="">-- Pilih kategori --</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}"
                    @selected(old('id_kategori', $produk->id_kategori ?? '') == $k->id_kategori)>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('id_kategori')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Kode Produk</label>
            <input type="text" name="kode_produk"
                   value="{{ old('kode_produk', $produk->kode_produk ?? '') }}"
                   class="w-full border rounded px-3 py-2">
            @error('kode_produk')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Satuan</label>
            <input type="text" name="satuan" placeholder="pcs, kg, pak..."
                   value="{{ old('satuan', $produk->satuan ?? '') }}"
                   class="w-full border rounded px-3 py-2">
            @error('satuan')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm mb-1">Nama Produk</label>
        <input type="text" name="nama_produk"
               value="{{ old('nama_produk', $produk->nama_produk ?? '') }}"
               class="w-full border rounded px-3 py-2">
        @error('nama_produk')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="3"
                  class="w-full border rounded px-3 py-2">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm mb-1">Harga Beli</label>
            <input type="number" step="0.01" min="0" name="harga_beli"
                   value="{{ old('harga_beli', $produk->harga_beli ?? 0) }}"
                   class="w-full border rounded px-3 py-2">
            @error('harga_beli')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Harga Jual</label>
            <input type="number" step="0.01" min="0" name="harga_jual"
                   value="{{ old('harga_jual', $produk->harga_jual ?? 0) }}"
                   class="w-full border rounded px-3 py-2">
            @error('harga_jual')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Stok</label>
            <input type="number" min="0" name="stok"
                   value="{{ old('stok', $produk->stok ?? 0) }}"
                   class="w-full border rounded px-3 py-2">
            @error('stok')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm mb-1">Keterangan</label>
        <textarea name="keterangan" rows="2"
                  class="w-full border rounded px-3 py-2">{{ old('keterangan', $produk->keterangan ?? '') }}</textarea>
        @error('keterangan')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('produk.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</div>
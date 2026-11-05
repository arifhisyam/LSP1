<div class="space-y-4">
    <div>
        <label class="block text-sm mb-1">Nama Kategori</label>
        <input type="text" name="nama_kategori"
               value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
               class="w-full border rounded px-3 py-2">
               @error('nama_kategori')
                   <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
               @enderror

    </div>

    <div>
        <label class="block text-sm mb-1">Keterangan</label>
        <textarea name="keterangan" rows="3"
                  class="w-full border rounded px-3 py-2">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
        @error('keterangan')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-2">
         <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
         <a href="{{ route('kategori.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</div>
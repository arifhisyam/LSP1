<div class="space-y-4">
    <div>
        <label class="block text-sm mb-1">Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan"
               value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}"
               class="w-full border rounded px-3 py-2">
        @error('nama_pelanggan')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm mb-1">Alamat</label>
        <textarea name="alamat" rows="3"
                  class="w-full border rounded px-3 py-2">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
        @error('alamat')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Telepon</label>
            <input type="text" name="telepon"
                   value="{{ old('telepon', $pelanggan->telepon ?? '') }}"
                   class="w-full border rounded px-3 py-2">
            @error('telepon')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $pelanggan->email ?? '') }}"
                   class="w-full border rounded px-3 py-2">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex gap-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</div>
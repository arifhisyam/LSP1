@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">User</h1>
        <a href="{{ route('user.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm text-gray-600">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Level</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $u)
                    <tr>
                        <td class="p-3">{{ $user->firstItem() + $loop->index }}</td>
                        <td class="p-3">{{ $u->nama_user }}</td>
                        <td class="p-3">{{ $u->username }}</td>
                        <td class="p-3">{{ ucfirst($u->level) }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs {{ $u->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                                {{ ucfirst($u->status) }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('user.edit', $u) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form method="POST" action="{{ route('user.destroy', $u) }}"
                            onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">Belum ada user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $user->links() }}</div>
@endsection
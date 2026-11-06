<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('nama_user')->paginate(10);
        return view('user.index', compact('user'));

    }

    public function create()
    {
        return view('user.create');
    }

    public function store (Request $request)
    {
        $data = $request->validate($this->rules());
        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit (User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate($this->rules($user));

        if(empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui');
    }


    public function destroy(User $user)
    {
        if($user->id_user === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        if($user->penjualan()->exists()) {
            return back()->with('error', 'User tidak bisa dihapus karena sudah punya transaksi. Nonaktifkan saja.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }

    private function rules(?User $user = null): array
    {
        return [
            'nama_user'             => 'required|string|max:100',
            'username'              => ['required', 'string', 'max:50', Rule::unique('user', 'username')->ignore($user?->id_user, 'id_user')
            ],

            'password'      => [$user ? 'nullable' : 'required', 'string', 'min:6'],
            'level'         => 'required|in:admin,kasir',
            'status'        => 'required|in:aktif,nonaktif',
        ];
    }
}

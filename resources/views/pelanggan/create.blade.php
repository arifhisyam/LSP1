@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Pelanggan</h1>

    <form method="POST" action="{{ route('pelanggan.store') }}"
          class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @include('pelanggan._form')
    </form>
@endsection
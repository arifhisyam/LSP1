@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form method="POST" action="{{ route('produk.store') }}"
          class="bg-white p-6 rounded-xl shadow max-w-2xl">
        @csrf
        @include('produk._form')
    </form>
@endsection
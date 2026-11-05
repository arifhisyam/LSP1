@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    <form method="POST" action="{{ route('produk.update', $produk) }}"
          class="bg-white p-6 rounded-xl shadow max-w-2xl">
        @csrf
        @method('PUT')
        @include('produk._form')
    </form>
@endsection
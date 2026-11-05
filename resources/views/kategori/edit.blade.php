@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    <form method="POST" action="{{ route('kategori.update', $kategori) }}"
          class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @method('PUT')
        @include('kategori._form')
    </form>
@endsection
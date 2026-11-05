@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>

    <form method="POST" action="{{ route('kategori.store') }}"
           class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @include('kategori._form')
        </form>

@endsection
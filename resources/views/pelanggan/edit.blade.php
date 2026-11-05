@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Pelanggan</h1>

    <form method="POST" action="{{ route('pelanggan.update', $pelanggan) }}"
          class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @method('PUT')
        @include('pelanggan._form')
    </form>
@endsection
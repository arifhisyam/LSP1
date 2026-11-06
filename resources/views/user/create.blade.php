@extends('layouts.app')

@section('title', 'Tambah user')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>

    <form method="POST" action="{{ route('user.store') }}"
          class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @include('user._form')
        </form>

@endsection
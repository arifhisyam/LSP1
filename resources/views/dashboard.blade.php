@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold">Halo, {{ auth()->user()->nama_user }}</h1>
    <p class="text-gray-600">Selamat datang di aplikasi penjualan.</p>
@endsection
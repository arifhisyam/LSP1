@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('user.update', $user) }}"
          class="bg-white p-6 rounded-xl shadow max-w-lg">
        @csrf
        @method('PUT')
        @include('user._form')
        </form>
@endsection
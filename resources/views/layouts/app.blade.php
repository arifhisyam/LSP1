<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Aplikasi Penjualan')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex">
    <aside class="w-60 bg-gray-900 text-gray-100 min-h-screen p-4 flex flex-col print:hidden">
        <h2 class="text-lg font-bold mb-6">Aplikasi Penjualan</h2>

        <nav class="space-y-1 flex-1">
            <a href="{{ route('dashboard') }}"
            class="block px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-800' }}">
                Dashboard
            </a>

            @if (auth()->user()->level === 'admin')
            <a href="{{ route('kategori.index') }}"
            class="block px-3 py-2 rounded {{ request()->routeIs('kategori.*') ? 'bg-gray-700' : 'hover:bg-gray-800' }}">
            Kategori
        </a>

        <a href="{{ route('produk.index') }}"
        class="block px-3 py-2 rounded {{ request()->routeIs('produk.*') ? 'bg-gray-700' : 'hover: bg-gray-800' }}">
        Produk
    </a>
            @endif

            <a href="{{ route('pelanggan.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('pelanggan.*') ? 'bg-gray-700' : 'hover:bg-gray-800' }}">
                Pelanggan
            </a>

            <a href="{{ route('penjualan.index') }}"
            class="block px-3 py-2 rounded {{ request()->routeIs('penjualan.*') ? 'bg-gray-700' : 'hover:ng-gray-800' }}">
            Transaksi
        </a>
        </nav>

        <div class="border-t border-gray-700 pt-4 text-sm">
            <p class="font-semibold">{{ auth()->user()->nama_user }}</p>
            <p class="text-gray-400 mb-3">{{ ucfirst(auth()->user()->level )}}</p>
            <form method ="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded">Logout</button>
            </form>

        </div>
    </aside>
    
    <main class="flex-1 p-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4 print:hidden">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4 print:hidden">{{ session('error') }}</div>          
            @endif

            @yield('content')
    </main>
        

</body>
</html>
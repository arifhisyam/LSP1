<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class ="min-h-screen bg-gray-100 flex items-center justify-center">
    <form method="POST" action="{{ route('login') }}"
    class="bg-white p-8 rounded-xl shadow w-full max-2-sm space-y-4">
    @csrf
   <h1 class="text-2xl font-bold text-center">Login</h1>

   @error('username')
        <div class = "bg-red-100 text-red-700 text-sm p-3 rounded">{{ $message }}</div>
   @enderror

   <div>
    <label class="block text-sm mb-1">Username</label>
    <input type="text" name="username" value="{{ old('username') }}" autofocus
            class="w-full boerder rounded px-3 py-2">
   </div>

   <div>
    <label class="block text-sm mb-1">Password</label>
    <input type="password" name="password" class="w-full border rounded px-3 py-2">
   </div>

   <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
    Masuk
   </button>
    </form>
</body>
</html>
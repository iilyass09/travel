<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - Admin Gaskeun Travel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
  <style>body{font-family:'Inter',sans-serif}.font-heading{font-family:'Poppins',sans-serif}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 flex items-center justify-center p-4">

  <div class="w-full max-w-md">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
      <div class="text-center mb-8">
        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4"><svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/></svg></div>
        <h1 class="font-heading font-bold text-2xl text-gray-900">GASKEUN<span class="text-orange-500">TRAVEL</span></h1>
        <p class="text-gray-500 text-sm mt-1">Super Admin Panel</p>
      </div>

      @if ($errors->any())
      <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-5">
        @csrf
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
          <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
          <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
        </div>
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Ingat saya
        </label>
        <button type="submit" class="w-full px-6 py-3.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-lg shadow-orange-500/30">Masuk</button>
      </form>

      <p class="text-center text-xs text-gray-400 mt-6">Default: username <code class="bg-gray-100 px-1.5 py-0.5 rounded">admin</code> / password <code class="bg-gray-100 px-1.5 py-0.5 rounded">admin</code></p>
    </div>
    <p class="text-center text-white/40 text-sm mt-6">
      <a href="{{ route('home') }}" class="hover:text-white transition-colors">← Kembali ke website</a>
    </p>
  </div>

</body>
</html>

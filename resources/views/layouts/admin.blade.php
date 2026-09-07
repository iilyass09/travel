<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin - Gaskeun Travel')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .font-heading { font-family: 'Poppins', sans-serif; }
  </style>
  @stack('head')
</head>
<body class="bg-gray-100 text-gray-900">

  <div class="min-h-screen md:flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-blue-950 text-white flex-shrink-0 md:flex md:flex-col fixed inset-y-0 left-0 z-40 -translate-x-full md:translate-x-0 transition-transform duration-300">
      <div class="p-5 border-b border-white/10 flex items-center gap-2">
        <div class="w-9 h-9 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center flex-shrink-0"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/></svg></div>
        <div>
          <p class="font-heading font-bold leading-tight">GASKEUN<span class="text-orange-400">TRAVEL</span></p>
          <p class="text-white/50 text-xs">Super Admin Panel</p>
        </div>
      </div>
      <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.dashboard')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          Dashboard
        </a>
        <a href="{{ route('admin.packages.index') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.packages.*')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
          Paket Wisata
        </a>
        <a href="{{ route('admin.destinasi.index') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.destinasi.*')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Destinasi
        </a>
        <a href="{{ route('admin.kuliner.index') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.kuliner.*')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546"/></svg>
          Kuliner
        </a>
        <a href="{{ route('admin.shopping.index') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.shopping.*')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          Shopping
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.testimonials.*')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
          Testimoni
        </a>
        <a href="{{ route('admin.settings') }}" class="admin-nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors text-sm font-medium @if(request()->routeIs('admin.settings')) bg-white/10 text-white @endif">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Pengaturan
        </a>
      </nav>
      <div class="p-4 border-t border-white/10">
        <p class="text-white/50 text-xs mb-2">Masuk sebagai <span class="text-white/80 font-medium">{{ auth()->user()->username }}</span></p>
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="w-full px-4 py-2.5 bg-white/10 hover:bg-red-500 text-white text-sm font-semibold rounded-xl transition-colors flex items-center justify-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Keluar</button>
        </form>
      </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0 md:ml-64">
      <header class="bg-white border-b border-gray-200 px-4 sm:px-6 py-3 flex items-center justify-between sticky top-0 z-30">
        <button id="sidebar-toggle" class="md:hidden p-2 -ml-2 rounded-lg hover:bg-gray-100" aria-label="Toggle sidebar">☰</button>
        <h1 class="font-heading font-bold text-lg md:text-xl truncate">@yield('header', 'Dashboard')</h1>
        <div class="flex items-center gap-3">
          <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">Lihat Website</a>
        </div>
      </header>

      <main class="flex-1 p-4 sm:p-6">
        @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium rounded-xl flex items-center justify-between">
          <span>{{ session('success') }}</span>
          <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">✕</button>
        </div>
        @endif
        @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">{{ session('error') }}</div>
        @endif

        @yield('content')
      </main>
    </div>
  </div>

  <script>
    document.getElementById('sidebar-toggle').addEventListener('click', function () {
      const sb = document.getElementById('sidebar');
      sb.classList.toggle('-translate-x-full');
      sb.classList.toggle('translate-x-0');
      sb.classList.toggle('md:translate-x-0');
    });
  </script>
  @stack('scripts')
</body>
</html>

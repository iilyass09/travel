<nav id="navbar" class="fixed top-0 left-0 right-0 z-[100] transition-all duration-300 bg-transparent">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      <a href="{{ route('home') }}#beranda" class="flex items-center gap-2 group">
        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/></svg>
        </div>
        <span class="font-heading font-bold text-xl text-white">GASKEUN<span class="text-orange-400">TRAVEL</span></span>
      </a>
      <div class="hidden md:flex items-center gap-8">
        <a href="{{ route('home') }}#beranda" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Beranda</a>
        <a href="{{ route('home') }}#paket" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Paket Wisata</a>
        <a href="{{ route('home') }}#destinasi" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Destinasi</a>
        <a href="{{ route('home') }}#kuliner" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Kuliner</a>
        <a href="{{ route('home') }}#shopping" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Shopping</a>
        <a href="{{ route('home') }}#kendaraan" class="nav-link text-white/80 hover:text-orange-400 font-medium transition-colors duration-200">Kendaraan</a>
        <a href="{{ route('home') }}#kontak" class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-full hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-orange-500/30">Hubungi Kami</a>
      </div>
      <button id="mobile-toggle" class="md:hidden relative w-10 h-10 flex items-center justify-center" aria-label="Toggle menu">
        <div class="hamburger">
          <span class="bar bar1 bg-white block w-6 h-0.5 mb-1.5 transition-all duration-300"></span>
          <span class="bar bar2 bg-white block w-6 h-0.5 mb-1.5 transition-all duration-300"></span>
          <span class="bar bar3 bg-white block w-6 h-0.5 transition-all duration-300"></span>
        </div>
      </button>
    </div>
  </div>
  <div id="mobile-menu" class="mobile-menu md:hidden hidden">
    <div class="bg-blue-900/95 backdrop-blur-xl px-4 py-6 space-y-1 border-t border-white/10">
      <a href="{{ route('home') }}#beranda" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Beranda</a>
      <a href="{{ route('home') }}#paket" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Paket Wisata</a>
      <a href="{{ route('home') }}#destinasi" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Destinasi</a>
      <a href="{{ route('home') }}#kuliner" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Kuliner</a>
      <a href="{{ route('home') }}#shopping" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Shopping</a>
      <a href="{{ route('home') }}#kendaraan" class="mobile-nav-link block px-4 py-3 text-white/80 hover:text-orange-400 hover:bg-white/5 rounded-xl font-medium transition-all duration-200">Kendaraan</a>
      <a href="{{ route('home') }}#kontak" class="mobile-nav-link block mx-4 mt-4 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-full text-center">Hubungi Kami</a>
    </div>
  </div>
</nav>

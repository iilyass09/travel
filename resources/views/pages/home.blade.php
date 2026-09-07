@extends('layouts.app')

@section('title', 'Gaskeun Travel - Jelajahi Bandung dengan Nyaman')

@section('content')

  <!-- Hero -->
  <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
    <div class="absolute inset-0">
      <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950"></div>
      <div class="absolute inset-0 hero-pattern opacity-20"></div>
      <div class="absolute top-20 right-10 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-20 left-10 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl animate-float-delayed"></div>
    </div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-32 left-[10%] w-4 h-4 bg-orange-400/30 rotate-45 animate-float-slow"></div>
      <div class="absolute top-48 right-[15%] w-3 h-3 bg-blue-300/30 rounded-full animate-float"></div>
      <div class="absolute bottom-40 left-[20%] w-5 h-5 bg-orange-400/20 rotate-12 animate-float-delayed"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right" data-aos-duration="800">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6">
            <span class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></span>
            <span class="text-white/90 text-sm font-medium">{{ setting('hero_badge', 'Best Seller City Tour Bandung') }}</span>
          </div>
          <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
            {{ setting('hero_title_part1', 'Jelajahi') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-300">{{ setting('hero_title_accent', 'Bandung') }}</span> {{ setting('hero_title_part2', 'dengan Nyaman & Menyenangkan') }}
          </h1>
          <p class="text-lg text-white/70 mb-8 max-w-lg leading-relaxed">
            {{ setting('hero_subtitle', 'Gaskeun Travel hadir untuk memberikan pengalaman wisata terbaik di Bandung. Nikmati perjalanan seru dengan driver berpengalaman dan kendaraan nyaman.') }}
          </p>
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('home') }}#paket" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full text-center hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-xl shadow-orange-500/30 flex items-center justify-center gap-2">
              Lihat Paket Wisata
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('home') }}#kontak" class="px-8 py-4 border-2 border-white/30 text-white font-bold rounded-full text-center hover:bg-white/10 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              Hubungi Sekarang
            </a>
          </div>
          <div class="flex flex-wrap gap-8 mt-12">
            <div class="text-center">
              <div class="font-heading text-3xl font-bold text-orange-400 counter" data-target="{{ setting('hero_stat1_count', '500') }}">0</div>
              <div class="text-white/60 text-sm mt-1">{{ setting('hero_stat1_label', 'Wisatawan Puas') }}</div>
            </div>
            <div class="text-center">
              <div class="font-heading text-3xl font-bold text-orange-400 counter" data-target="{{ setting('hero_stat2_count', '50') }}">0</div>
              <div class="text-white/60 text-sm mt-1">{{ setting('hero_stat2_label', 'Destinasi Wisata') }}</div>
            </div>
            <div class="text-center">
              <div class="font-heading text-3xl font-bold text-orange-400">{{ setting('hero_stat3_count', '5') }}<span class="text-lg">{{ setting('hero_stat3_suffix', '+') }}</span></div>
              <div class="text-white/60 text-sm mt-1">{{ setting('hero_stat3_label', 'Tahun Pengalaman') }}</div>
            </div>
          </div>
        </div>
        <div class="relative hidden lg:block" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
          <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-orange-500/20 to-blue-500/20 rounded-3xl blur-2xl"></div>
            <div class="relative bg-white/10 backdrop-blur-xl rounded-3xl border border-white/20 p-8 transform hover:scale-[1.02] transition-transform duration-500">
              <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center relative">
                @php
                  $hImgs = array_values(array_filter([
                    setting('hero_card_image'),
                    setting('hero_card_image2'),
                    setting('hero_card_image3'),
                  ], fn ($v) => !empty($v)));
                  $hCount = count($hImgs);
                @endphp
                @if ($hCount > 0)
                  @foreach ($hImgs as $i => $hImg)
                  <img src="{{ storage_url($hImg) }}" alt="{{ setting('hero_card_eyebrow', 'GASKEUN TRAVEL') }}" class="absolute inset-0 w-full h-full object-cover @if($hCount > 1) hero-slide-{{ $hCount }} @endif" @if($i > 0) style="animation-delay: -{{ $i * 5 }}s;" @endif>
                  @endforeach
                @else
                <div class="text-center">
                  <svg class="w-24 h-24 text-orange-400/60 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/></svg>
                  <p class="text-white/60 font-heading font-bold text-lg">{{ setting('hero_card_eyebrow', 'GASKEUN TRAVEL') }}</p>
                  <p class="text-white/40 text-sm mt-1">{{ setting('hero_card_subtitle', 'Your Bandung Adventure Starts Here') }}</p>
                </div>
                @endif
              </div>
              <div class="grid grid-cols-3 gap-3 mt-4">
                @foreach (array_filter(explode('|', setting('hero_vehicles', 'Lembang|Ciwidey|Pangalengan')), fn ($v) => trim($v) !== '') as $v)
                <div class="bg-white/10 rounded-xl p-3 text-center">
                  <svg class="w-6 h-6 text-orange-400 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  <p class="text-white/70 text-xs font-medium">{{ trim($v) }}</p>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
      <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
        <div class="w-1.5 h-3 bg-orange-400 rounded-full mt-2 animate-scroll-dot"></div>
      </div>
    </div>
  </section>

  <!-- Best Seller Paket -->
  <section id="paket" class="py-24 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-blue-100/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="text-center mb-16" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 rounded-full mb-4">
          <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          <span class="text-orange-700 font-semibold text-sm">{{ setting('paket_badge', 'Best Seller') }}</span>
        </div>
        <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">{{ setting('paket_title_prefix', 'Paket') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ setting('paket_title_accent', 'City Tour Bandung') }}</span></h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ setting('paket_subtitle', 'Pilihan paket wisata terbaik untuk menjelajahi keindahan Bandung') }}</p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        @foreach ($packages as $i => $package)
        <div class="group" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
          <a href="{{ route('package.show', $package) }}" class="absolute inset-0 z-10 cursor-pointer" aria-label="Lihat detail paket wisata {{ $package->name }}"></a>
          <div class="relative bg-white rounded-3xl shadow-xl shadow-blue-100/50 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 h-full flex flex-col">
            <div class="relative h-56 overflow-hidden">
              @if ($package->coverUrl())
                <img src="{{ $package->coverUrl() }}" alt="{{ $package->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              @else
                <div class="absolute inset-0 bg-gradient-to-br {{ $package->card_gradient }} group-hover:scale-110 transition-transform duration-700"></div>
                <div class="absolute inset-0 flex items-center justify-center"><svg class="w-20 h-20 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
              @endif
              @if ($package->badge)
              <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full"><span class="text-green-700 font-bold text-sm">{{ $package->badge }}</span></div>
              @endif
            </div>
            <div class="p-6 flex flex-col flex-1">
              <div class="flex items-center gap-2 mb-3"><svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><h3 class="font-heading font-bold text-xl text-gray-900">{{ $package->name }}</h3></div>
              <p class="text-gray-600 text-sm mb-4 leading-relaxed flex-1">{{ $package->short_desc }}</p>
              <div class="flex items-center justify-between">
                <div>
                  <div class="text-gray-400 text-xs">Mulai dari</div>
                  <div class="font-heading font-extrabold text-xl text-gray-900">{{ $package->price ?? 'Custom' }}</div>
                </div>
                <a href="{{ wa_link('Halo Gaskeun Travel, saya ingin memesan paket ' . $package->name . '. Mohon infonya.') }}" target="_blank" rel="noopener noreferrer" class="relative z-20 px-5 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-bold rounded-full hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/30 transition-all duration-200">Pesan</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Destinasi -->
  <section id="destinasi" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-orange-500 to-blue-600"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-full mb-4"><svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg><span class="text-blue-700 font-semibold text-sm">{{ setting('destinasi_badge', 'Tempat Wisata') }}</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">{{ setting('destinasi_title_prefix', 'Destinasi') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-600">{{ setting('destinasi_title_accent', 'Wisata') }}</span> {{ setting('destinasi_title_suffix', 'Bandung') }}</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ setting('destinasi_subtitle', 'Jelajahi berbagai tempat wisata menarik di seluruh penjuru Bandung') }}</p>
      </div>
      <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up" data-aos-delay="100">
        <button class="dest-tab active px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300 bg-blue-600 text-white shadow-lg shadow-blue-200" data-filter="all">Semua</button>
        <button class="dest-tab px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700" data-filter="alami">Alami</button>
        <button class="dest-tab px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700" data-filter="kota">Kota</button>
        <button class="dest-tab px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700" data-filter="wisata">Wisata Populer</button>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="dest-grid">
        @foreach ($destinations as $i => $d)
        <div class="dest-card group cursor-pointer" data-category="{{ $d->category }}" data-aos="zoom-in" data-aos-delay="{{ ($i % 4) * 50 }}">
          <div class="relative rounded-2xl overflow-hidden aspect-square">
            @if ($d->imageUrl())
              <img src="{{ $d->imageUrl() }}" alt="{{ $d->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            @else
              <div class="absolute inset-0 bg-gradient-to-br {{ $d->gradient }} group-hover:scale-110 transition-transform duration-700"></div>
            @endif
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4"><svg class="w-10 h-10 mb-2 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span class="font-heading font-bold text-sm md:text-base text-center">{{ $d->name }}</span></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Kuliner -->
  <section id="kuliner" class="py-24 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-100/50 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="text-center mb-16" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 rounded-full mb-4"><svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546M12 2v4m0 0a2 2 0 100 4 2 2 0 000-4z"/></svg><span class="text-orange-700 font-semibold text-sm">{{ setting('kuliner_badge', 'Kuliner Nikmat') }}</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">{{ setting('kuliner_title_prefix', 'Spot') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-600">{{ setting('kuliner_title_accent', 'Kuliner') }}</span> {{ setting('kuliner_title_suffix', 'Bandung') }}</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ setting('kuliner_subtitle', 'Cicipi berbagai kuliner lezat khas Bandung yang menggugah selera') }}</p>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($kulinerSpots as $i => $k)
        <div class="kuliner-card group" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
          <div class="bg-white rounded-2xl p-6 shadow-lg shadow-orange-100/50 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 border border-gray-100 h-full">
            <div class="flex items-start gap-4">
              <div class="w-14 h-14 bg-gradient-to-br {{ $k->gradient }} rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300"><svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/></svg></div>
              <div>
                <h3 class="font-heading font-bold text-lg text-gray-900 mb-1">{{ $k->name }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $k->description }}</p>
                @if ($k->tagList())
                <div class="mt-3 flex items-center flex-wrap gap-2">
                  @foreach ($k->tagList() as $idx => $tag)
                    @php $colors = ['bg-orange-100 text-orange-700', 'bg-blue-100 text-blue-700', 'bg-green-100 text-green-700', 'bg-purple-100 text-purple-700', 'bg-red-100 text-red-700', 'bg-yellow-100 text-yellow-700']; @endphp
                    <span class="px-3 py-1 {{ $colors[$idx % count($colors)] }} text-xs font-semibold rounded-full">{{ $tag }}</span>
                  @endforeach
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Shopping -->
  <section id="shopping" class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="text-center mb-16" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-full mb-4"><svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg><span class="text-blue-700 font-semibold text-sm">{{ setting('shopping_badge', 'Shopping Seru') }}</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">{{ setting('shopping_title_prefix', 'Tempat') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ setting('shopping_title_accent', 'Shopping') }}</span> {{ setting('shopping_title_suffix', 'Bandung') }}</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ setting('shopping_subtitle', 'Belanja sepuasnya di berbagai tempat shopping favorit di Bandung') }}</p>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($shoppingSpots as $i => $s)
        <div class="group" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
          <div class="bg-gradient-to-br {{ $s->gradient }} rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 h-full">
            <svg class="w-8 h-8 mb-3 {{ $s->icon_light }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <h3 class="font-heading font-bold text-lg mb-1">{{ $s->name }}</h3>
            <p class="text-white/70 text-sm">{{ $s->description }}</p>
          </div>
        </div>
        @endforeach
      </div>
      <div class="text-center mt-8" data-aos="fade-up"><p class="text-gray-500 text-sm italic">{{ setting('shopping_note', 'Dan masih banyak tempat shopping lainnya yang bisa dikunjungi') }}</p></div>
    </div>
  </section>

  <!-- Kendaraan -->
  <section id="kendaraan" class="py-24 bg-gradient-to-b from-blue-900 via-blue-950 to-blue-900 relative overflow-hidden">
    <div class="absolute inset-0"><div class="absolute top-10 left-10 w-80 h-80 bg-orange-500/5 rounded-full blur-3xl"></div><div class="absolute bottom-10 right-10 w-64 h-64 bg-blue-400/5 rounded-full blur-3xl"></div></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right" data-aos-duration="800">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-full mb-6"><svg class="w-4 h-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg><span class="text-white/90 font-semibold text-sm">{{ setting('kendaraan_badge', 'Kendaraan Kami') }}</span></div>
          <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-6">{{ setting('kendaraan_title_part1', 'Calya / Sigra') }} <span class="text-orange-400">{{ setting('kendaraan_title_accent', 'Terbaik') }}</span></h2>
          <p class="text-white/70 text-lg mb-8 leading-relaxed">{{ setting('kendaraan_subtitle', 'Kendaraan nyaman dan terawat untuk perjalanan wisata Anda. Dilengkapi dengan driver berpengalaman yang siap menemani petualangan Anda di Bandung.') }}</p>
          <div class="space-y-4">
            @foreach ($vehicleFeatures as $i => $f)
            <div class="flex items-start gap-4 p-4 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 hover:bg-white/10 transition-colors duration-300" data-aos="fade-up" data-aos-delay="{{ 100 + $i * 100 }}">
              <div class="w-12 h-12 bg-gradient-to-br {{ $f->gradient }} rounded-xl flex items-center justify-center flex-shrink-0"><svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
              <div><h3 class="font-heading font-bold text-white mb-1">{{ $f->title }}</h3><p class="text-white/60 text-sm">{{ $f->text }}</p></div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
          <div class="relative">
            <div class="absolute -inset-8 bg-gradient-to-r from-orange-500/10 to-blue-500/10 rounded-3xl blur-2xl"></div>
            <div class="relative bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 p-8 overflow-hidden">
<div class="aspect-[16/10] rounded-2xl overflow-hidden bg-gradient-to-br from-blue-800/50 to-blue-900/50 flex items-center justify-center relative">
                @php $kImg1 = setting('kendaraan_panel_image'); $kImg2 = setting('kendaraan_panel_image2'); @endphp
                @if ($kImg1 || $kImg2)
                  @if ($kImg2)
                    <img src="{{ storage_url($kImg2) }}" alt="{{ setting('kendaraan_panel_subtitle', 'Calya / Sigra') }}" class="absolute inset-0 w-full h-full object-cover">
                    @if ($kImg1)
                    <img src="{{ storage_url($kImg1) }}" alt="{{ setting('kendaraan_panel_subtitle', 'Calya / Sigra') }}" class="kendaraan-slide kendaraan-slide-1 absolute inset-0 w-full h-full object-cover">
                    @endif
                  @else
                    <img src="{{ storage_url($kImg1) }}" alt="{{ setting('kendaraan_panel_subtitle', 'Calya / Sigra') }}" class="absolute inset-0 w-full h-full object-cover">
                  @endif
                  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                  <div class="absolute inset-0 flex items-end justify-center p-6">
                    <div class="text-center"><div class="font-heading font-extrabold text-3xl sm:text-4xl text-white mb-1 drop-shadow-lg">{{ setting('kendaraan_panel_title', 'CALYA / SIGRA') }}</div><div class="text-white/80 text-sm">{{ setting('kendaraan_panel_subtitle', 'Comfortable & Safe') }}</div></div>
                  </div>
                @else
                <div class="absolute inset-0 flex items-center justify-center">
                  <div class="text-center"><div class="font-heading font-extrabold text-4xl sm:text-5xl text-white/10 mb-2">{{ setting('kendaraan_panel_title', 'CALYA / SIGRA') }}</div><div class="text-white/30 text-sm">{{ setting('kendaraan_panel_subtitle', 'Comfortable & Safe') }}</div></div>
                </div>
                @endif
              </div>
              <div class="grid grid-cols-3 gap-4 mt-6">
                @foreach ($vehicleStats as $stat)
                <div class="text-center p-3 bg-white/5 rounded-xl"><div class="font-heading font-bold text-orange-400 text-lg">{{ $stat->title }}</div><div class="text-white/50 text-xs">{{ $stat->caption }}</div></div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="kontak" class="py-24 bg-gradient-to-br from-orange-500 to-orange-600 relative overflow-hidden">
    <div class="absolute inset-0"><div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div><div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div></div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none"><div class="absolute top-20 left-[15%] w-3 h-3 bg-white/20 rounded-full animate-float"></div><div class="absolute top-40 right-[20%] w-2 h-2 bg-white/30 rotate-45 animate-float-slow"></div><div class="absolute bottom-20 left-[30%] w-4 h-4 bg-white/15 rounded-full animate-float-delayed"></div></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center" data-aos="zoom-in" data-aos-duration="800">
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 rounded-full mb-6"><svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg><span class="text-white/90 font-semibold text-sm">{{ setting('cta_badge', 'Hubungi Kami Sekarang') }}</span></div>
      <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-6">{{ setting('cta_title', 'Siap Jelajahi Bandung?') }}</h2>
      <p class="text-white/80 text-lg mb-10 max-w-2xl mx-auto">{{ setting('cta_subtitle', 'Jangan tunda lagi! Pesan paket wisata sekarang dan nikmati petualangan seru di Bandung bersama Gaskeun Travel.') }}</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ wa_link() }}" target="_blank" rel="noopener noreferrer" class="group px-8 py-4 bg-white text-orange-600 font-bold rounded-full text-center hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-xl flex items-center justify-center gap-3"><svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>Chat WhatsApp</a>
        <a href="tel:{{ setting('wa_number', '6281234567890') }}" class="group px-8 py-4 border-2 border-white text-white font-bold rounded-full text-center hover:bg-white/10 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-3"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>Telepon Sekarang</a>
      </div>
    </div>
  </section>

@endsection

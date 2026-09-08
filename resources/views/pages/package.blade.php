@extends('layouts.app')

@section('title', 'Paket Wisata ' . $package->name . ' - Gaskeun Travel')
@section('meta_description', $package->meta_description)
@section('body_class', 'detail-page font-body bg-white text-gray-900 overflow-x-hidden dark:bg-gray-950 dark:text-gray-100')

@push('scripts')
<script src="{{ asset('js/detail.js') }}"></script>
@endpush

@section('content')

  <!-- Hero Halaman Detail -->
  <header class="relative min-h-[70vh] flex items-center overflow-hidden pt-20">
    <div class="absolute inset-0">
      <div class="absolute inset-0 bg-gradient-to-br {{ $package->detail_gradient }}"></div>
      <div class="absolute inset-0 hero-pattern opacity-20"></div>
      <div class="absolute top-24 right-10 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-16 left-10 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl animate-float-delayed"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
      <nav class="text-white/60 text-sm mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-orange-400 transition-colors">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('home') }}#paket" class="hover:text-orange-400 transition-colors">Paket Wisata</a>
        <span class="mx-2">/</span>
        <span class="text-orange-400 font-medium">{{ $package->name }}</span>
      </nav>
      <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div data-aos="fade-right" data-aos-duration="800">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6">
            <span class="w-2 h-2 {{ $package->badge_dot_class }} rounded-full animate-pulse"></span>
            <span class="text-white/90 text-sm font-medium">{{ $package->badge ?? 'City Tour' }}</span>
          </div>
          <h1 class="font-heading text-4xl sm:text-5xl font-extrabold text-white leading-tight mb-4">Paket Wisata <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-300">{{ $package->name }}</span></h1>
          <p class="text-lg text-white/70 mb-8 max-w-lg leading-relaxed">{{ $package->tagline }}</p>
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ wa_link('Halo Gaskeun Travel, saya ingin memesan paket wisata ' . $package->name . ' (mulai ' . $package->price . '). Mohon infonya.') }}" target="_blank" rel="noopener noreferrer" class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full text-center hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-xl shadow-orange-500/30 flex items-center justify-center gap-2">
              Pesan Sekarang
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="#itinerary" class="px-8 py-4 border-2 border-white/30 text-white font-bold rounded-full text-center hover:bg-white/10 transform hover:scale-105 transition-all duration-200">Lihat Itinerary</a>
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-10">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-4 text-center">
              <svg class="w-6 h-6 text-orange-400 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <div class="font-heading font-bold text-white text-lg">{{ $package->duration ?? '±10 Jam' }}</div>
              <div class="text-white/50 text-xs">Perjalanan</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-4 text-center">
              <svg class="w-6 h-6 text-orange-400 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <div class="font-heading font-bold text-white text-lg">{{ $package->seat_count ?? '7 Seat' }}</div>
              <div class="text-white/50 text-xs">{{ $package->seat_note ?? 'Calya / Sigra' }}</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-4 text-center">
              <svg class="w-6 h-6 text-orange-400 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              <div class="font-heading font-bold text-orange-400 text-lg">{{ preg_replace('/[^0-9.]/', '', $package->price ?? '') }}</div>
              <div class="text-white/50 text-xs">Mulai dari</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-4 text-center">
              <svg class="w-6 h-6 text-orange-400 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
              <div class="font-heading font-bold text-white text-lg">Included</div>
              <div class="text-white/50 text-xs">BBM + Driver</div>
            </div>
          </div>
        </div>
        <div class="relative hidden lg:block" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
          <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-orange-500/20 to-emerald-500/20 rounded-3xl blur-2xl"></div>
            <div class="relative bg-white/10 backdrop-blur-xl rounded-3xl border border-white/20 p-6 transform hover:scale-[1.02] transition-transform duration-500">
              <div class="rounded-2xl overflow-hidden h-80 relative">
                @if ($package->coverUrl())
                  <img src="{{ $package->coverUrl() }}" alt="{{ $package->name }}" class="absolute inset-0 w-full h-full object-cover">
                @else
                  <div class="absolute inset-0 bg-gradient-to-br {{ $package->card_gradient }}"></div>
                  <svg class="absolute inset-0 m-auto w-24 h-24 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @endif
              </div>
              <div class="mt-4 flex items-center justify-between px-1">
                <div>
                  <p class="text-white/60 text-sm">Harga mulai dari</p>
                  <div class="flex items-baseline gap-2">@if ($package->price_compare)<span class="text-white/40 text-sm line-through">{{ $package->price_compare }}</span>@endif<span class="font-heading font-extrabold text-2xl text-orange-400">{{ $package->price ?? 'Custom' }}</span></div>
                </div>
                <a href="#harga" class="px-5 py-2.5 bg-white/10 border border-white/20 text-white text-sm font-semibold rounded-full hover:bg-white/20 transition-colors">Lihat Harga</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Sub-nav sticky -->
  <nav class="detail-subnav bg-white/90 dark:bg-gray-950/90 backdrop-blur-xl border-b border-gray-100 dark:border-gray-800 shadow-sm" aria-label="Navigasi paket">
    <div class="detail-subnav-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex gap-2 items-center">
      <a href="#itinerary" class="subnav-link">Itinerary</a>
      <a href="#fasilitas" class="subnav-link">Fasilitas</a>
      <a href="#harga" class="subnav-link">Harga</a>
      <a href="#galeri" class="subnav-link">Galeri</a>
      <a href="#testimoni" class="subnav-link">Testimoni</a>
      <a href="#faq" class="subnav-link">FAQ</a>
      <a href="#pesan" class="ml-auto flex-shrink-0 px-5 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold rounded-full hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-lg shadow-orange-500/30">Pesan</a>
    </div>
  </nav>

  <!-- Itinerary -->
  <section id="itinerary" class="detail-anchor py-20 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-950">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-500/20 rounded-full mb-4">
          <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
          <span class="text-green-700 dark:text-green-300 font-semibold text-sm">Rencana Perjalanan</span>
        </div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">Itinerary <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-green-600">{{ $package->name }}</span></h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">Rute perjalanan yang fleksibel dan bisa disesuaikan dengan keinginan Anda</p>
      </div>
      <div class="timeline">
        @foreach ($package->itineraries as $i => $item)
        <div class="timeline-item" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
          <div class="timeline-dot"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg></div>
          <div class="timeline-card">
            <div class="bg-white dark:bg-gray-800 dark:border-gray-700 rounded-2xl p-5 shadow-lg shadow-gray-100 dark:shadow-none border border-gray-100">
              <div class="flex items-center gap-2 mb-1"><span class="px-3 py-1 bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 text-xs font-bold rounded-full">{{ $item->time }}</span><span class="text-gray-400 dark:text-gray-500 text-xs font-medium">{{ $item->label }}</span></div>
              <h3 class="font-heading font-bold text-lg text-gray-900 dark:text-white mb-1">{{ $item->title }}</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $item->description }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Fasilitas -->
  <section id="fasilitas" class="detail-anchor py-20 bg-white dark:bg-gray-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-500/20 rounded-full mb-4">
          <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          <span class="text-blue-700 dark:text-blue-300 font-semibold text-sm">Yang Termasuk</span>
        </div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">Fasilitas <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Paket</span></h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">Transparan tanpa biaya tersembunyi</p>
      </div>
      <div class="grid md:grid-cols-2 gap-6" data-aos="fade-up">
        <div class="bg-emerald-50/60 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800/60 rounded-3xl p-6">
          <h3 class="font-heading font-bold text-lg text-emerald-700 dark:text-emerald-300 mb-4 flex items-center gap-2"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Sudah Termasuk</h3>
          <ul class="space-y-3 text-gray-700 dark:text-gray-300 text-sm">
            @foreach ($package->included as $f)
            <li class="flex items-start gap-3"><span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>{{ $f->text }}</li>
            @endforeach
          </ul>
        </div>
        <div class="bg-red-50/60 dark:bg-red-900/30 border border-red-100 dark:border-red-800/60 rounded-3xl p-6">
          <h3 class="font-heading font-bold text-lg text-red-600 dark:text-red-300 mb-4 flex items-center gap-2"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Tidak Termasuk</h3>
          <ul class="space-y-3 text-gray-700 dark:text-gray-300 text-sm">
            @foreach ($package->excluded as $f)
            <li class="flex items-start gap-3"><span class="w-5 h-5 rounded-full bg-red-400 text-white flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></span>{{ $f->text }}</li>
            @endforeach
          </ul>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 italic">Tiket masuk bisa diakomodasi dengan <a href="#pesan" class="text-blue-600 underline">Paket Plus</a> sesuai tujuan wisata Anda.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Harga -->
  <section id="harga" class="detail-anchor py-20 bg-gradient-to-b from-white to-gray-50 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 dark:bg-orange-500/20 rounded-full mb-4"><span class="text-orange-700 dark:text-orange-300 font-semibold text-sm">Transparan &amp; Hemat</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">Pilihan <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-600">Harga</span></h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">Harga per kendaraan (trip), bukan per orang. Bebas mobil, driver, dan BBM.</p>
      </div>
      <div class="grid md:grid-cols-3 gap-6" data-aos="fade-up">
        @foreach ($package->pricingTiers as $tier)
        <div class="relative bg-white dark:bg-gray-800 rounded-3xl border-2 border-gray-200 dark:border-gray-700 p-6 shadow-lg flex flex-col">
          @if ($tier->badge)
          <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 {{ $tier->badge_class }} text-white text-xs font-bold rounded-full shadow-lg">{{ $tier->badge }}</span>
          @endif
          <h3 class="font-heading font-bold text-xl text-gray-900 dark:text-white mb-1">{{ $tier->name }}</h3>
          <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">{{ $tier->subtitle }}</p>
          <div class="font-heading text-3xl font-extrabold text-blue-700 dark:text-blue-400 mb-1">{{ $tier->price }}</div>
          <p class="text-gray-400 text-sm mb-5 @if(!$tier->price_compare) h-5 @endif">{{ $tier->price_compare ?: '' }}</p>
          @if ($tier->note)
          <p class="text-gray-400 text-sm mb-5">{{ $tier->note }}</p>
          @endif
          <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-6 flex-1">
            @foreach ($tier->featureList() as $feature)
            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>{{ $feature }}</li>
            @endforeach
          </ul>
          <a href="{{ wa_link('Halo Gaskeun Travel, saya ingin memesan ' . $tier->name . ' ' . $package->name . ' ' . $tier->price . '. Mohon infonya.') }}" target="_blank" rel="noopener noreferrer" class="px-6 py-3 {{ $tier->button_class }} text-white font-semibold rounded-full text-center hover:opacity-90 transform hover:scale-105 transition-all duration-200 shadow-lg">{{ $tier->button_text ?? 'Pilih Paket' }}</a>
        </div>
        @endforeach
      </div>
      <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-8" data-aos="fade-up"><span class="font-semibold text-blue-700 dark:text-blue-400">Catatan:</span> Harga dapat berubah sewaktu-waktu. Konfirmasi harga terbaik di WhatsApp kami.</p>
    </div>
  </section>

  <!-- Galeri -->
  <section id="galeri" class="detail-anchor py-20 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-100 dark:bg-purple-500/20 rounded-full mb-4"><span class="text-purple-700 dark:text-purple-300 font-semibold text-sm">Galeri</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">Serunya <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-indigo-600">{{ $package->name }}</span></h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">Dokumentasi momen dan destinasi terbaik selama wisata {{ $package->name }}</p>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach ($package->gallery as $i => $photo)
        <div class="gallery-card relative rounded-2xl aspect-square" data-aos="zoom-in" data-aos-delay="{{ ($i % 4) * 100 }}">
          @if ($photo->image)
            <img src="{{ $photo->url() }}" alt="{{ $photo->caption }}" class="absolute inset-0 w-full h-full object-cover rounded-2xl">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent rounded-2xl"></div>
          @else
            <div class="gallery-bg absolute inset-0 bg-gradient-to-br {{ $photo->gradient }}"></div>
            <div class="absolute inset-0 flex items-center justify-center"><svg class="w-12 h-12 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          @endif
          @if ($photo->caption)
          <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/70 to-transparent"><p class="text-white font-heading font-bold text-sm md:text-base drop-shadow-md">{{ $photo->caption }}</p></div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section id="testimoni" class="detail-anchor py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 dark:bg-yellow-500/20 rounded-full mb-4"><span class="text-yellow-700 dark:text-yellow-300 font-semibold text-sm">Kata Mereka</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">Testimoni <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-orange-600">Wisatawan</span></h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">Pengalaman menyenangkan dari wisatawan yang pernah bersama kami</p>
      </div>
      <div class="grid md:grid-cols-3 gap-6">
        @foreach ($package->testimonials as $i => $t)
        <div class="bg-white dark:bg-gray-800 dark:border-gray-700 rounded-3xl p-6 shadow-lg shadow-gray-100 dark:shadow-none border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
          <div class="flex gap-1 mb-3">
            @for ($s = 1; $s <= 5; $s++)
            <svg class="w-4 h-4 {{ $s <= $t->rating ? 'text-orange-400' : 'text-orange-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
          </div>
          <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-4">{{ $t->text }}</p>
          <div class="flex items-center gap-3"><div class="w-11 h-11 rounded-full bg-gradient-to-br {{ $t->avatar_gradient }} flex items-center justify-center text-white font-bold font-heading">{{ $t->initials() }}</div><div><p class="font-heading font-bold text-sm text-gray-900 dark:text-white">{{ $t->name }}</p><p class="text-gray-400 text-xs">{{ $t->role }}</p></div></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="detail-anchor py-20 bg-white dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-500/20 rounded-full mb-4"><span class="text-blue-700 dark:text-blue-300 font-semibold text-sm">Pertanyaan Umum</span></div>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">FAQ <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ $package->name }}</span></h2>
      </div>
      <div class="space-y-3" data-aos="fade-up">
        @foreach ($package->faqs as $i => $faq)
        <div class="faq-item @if($i === 0) open @endif">
          <button type="button" class="faq-question">{{ $faq->question }}<span class="faq-chevron"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg></span></button>
          <div class="faq-answer"><div class="faq-answer-inner">{{ $faq->answer }}</div></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Booking / CTA -->
  <section id="pesan" class="detail-anchor py-20 bg-gradient-to-br from-blue-900 via-blue-950 to-blue-900 relative overflow-hidden">
    <div class="absolute inset-0"><div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div><div class="absolute bottom-0 left-0 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div></div>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right" data-aos-duration="800">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-full mb-6">
            <svg class="w-4 h-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span class="text-white/90 font-semibold text-sm">Reservasi Cepat</span>
          </div>
          <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white mb-4">Siap Jelajah <span class="text-orange-400">{{ $package->name }}</span>?</h2>
          <p class="text-white/70 text-lg mb-8 leading-relaxed">Isi form pemesanan, dan pesan wisata Anda akan dikirim otomatis ke WhatsApp kami untuk konfirmasi cepat.</p>
          <ul class="space-y-3 text-white/80 text-sm mb-8">
            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Mulai dari {{ $package->price ?? 'Custom' }} per kendaraan</li>
            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Waktu fleksibel &amp; rute custom</li>
            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Respons cepat via WhatsApp</li>
          </ul>
          <a href="tel:{{ setting('wa_number', '6281234567890') }}" class="inline-flex items-center gap-3 text-white/80 hover:text-white transition-colors"><svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>{{ setting('phone_display', '+62 812-3456-7890') }}</a>
        </div>
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
          <h3 class="font-heading font-bold text-xl text-gray-900 mb-6">Form Pemesanan</h3>
          <form id="booking-form" data-paket="{{ $package->name }} {{ $package->category }}" class="space-y-4">
            <div>
              <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" required placeholder="Nama Anda" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Wisata</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
              </div>
              <div>
                <label for="pax" class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Orang</label>
                <select id="pax" name="pax" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
                  <option value="2">2 orang</option><option value="3">3 orang</option><option value="4">4 orang</option><option value="5">5 orang</option><option value="6" selected>6 orang</option><option value="7">7 orang</option>
                </select>
              </div>
            </div>
            <div>
              <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1.5">Catatan / Titik Penjemputan</label>
              <textarea id="catatan" name="catatan" rows="3" placeholder="Misal: jemput di Hotel Aston Pasteur pukul 07.00..." class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm resize-none"></textarea>
            </div>
            <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:from-orange-600 hover:to-orange-700 transform hover:scale-[1.02] transition-all duration-200 shadow-xl shadow-orange-500/30 flex items-center justify-center gap-2"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>Pesan via WhatsApp</button>
            <p class="text-center text-xs text-gray-500">Dengan menekan tombol di atas, Anda akan diarahkan ke WhatsApp kami.</p>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Paket Lainnya -->
  <section class="py-20 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="font-heading text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Paket Wisata <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-600">Lainnya</span></h2>
        <p class="text-gray-600 dark:text-gray-400">Lanjutkan petualangan Anda ke destinasi favorit lainnya</p>
      </div>
      <div class="grid md:grid-cols-2 gap-6">
        @foreach ($others as $i => $o)
        <a href="{{ route('package.show', $o) }}" class="group relative overflow-hidden rounded-3xl bg-gradient-to-br {{ $o->card_gradient }} p-8 text-white transform hover:scale-[1.02] transition-all duration-300 shadow-xl {{ $i % 2 === 0 ? 'shadow-blue-100' : 'shadow-emerald-100' }}" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
          <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full"></div>
          <div class="flex items-center justify-between mb-8">
            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">{{ $o->category }}</span>
            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </div>
          <h3 class="font-heading font-bold text-2xl mb-1">{{ $o->name }}</h3>
          <p class="text-white/70 text-sm mb-4">{{ $o->tagline }}</p>
          <p class="font-heading font-extrabold text-2xl">Mulai <span class="text-yellow-300">{{ $o->price ?? 'Custom' }}</span></p>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Sticky booking bar (mobile) -->
  <div id="sticky-book" class="md:hidden fixed bottom-0 left-0 right-0 z-[85] bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-gray-100 dark:border-gray-800 px-4 py-3 flex items-center justify-between gap-4">
    <div class="min-w-0"><p class="text-xs text-gray-500 dark:text-gray-400">Mulai dari</p><p class="font-heading font-bold text-blue-700 dark:text-blue-400">{{ $package->price ?? 'Custom' }} @if($package->price_compare)<span class="text-gray-400 line-through text-sm font-normal">{{ $package->price_compare }}</span>@endif</p></div>
    <a href="{{ wa_link('Halo Gaskeun Travel, saya ingin memesan paket ' . $package->name . '. Mohon infonya.') }}" target="_blank" rel="noopener noreferrer" class="flex-shrink-0 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full text-sm shadow-lg shadow-orange-500/30">Pesan Sekarang</a>
  </div>

@endsection

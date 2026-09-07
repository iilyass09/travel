@extends('layouts.admin')

@section('title', 'Paket Wisata')
@section('header', 'Paket Wisata')

@section('content')
  <div class="mb-6 flex justify-end">
    <a href="{{ route('admin.packages.create') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">+ Tambah Paket</a>
  </div>

  <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse ($packages as $package)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="relative h-40 bg-gradient-to-br {{ $package->card_gradient }}">
        @if ($package->coverUrl())
          <img src="{{ $package->coverUrl() }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        @endif
        <div class="absolute top-3 right-3 flex gap-2">
          @if($package->active)<span class="px-2 py-0.5 bg-green-500 text-white text-xs font-semibold rounded-full">Aktif</span>@else<span class="px-2 py-0.5 bg-gray-500 text-white text-xs font-semibold rounded-full">Nonaktif</span>@endif
          @if($package->badge)<span class="px-2 py-0.5 bg-white/90 text-blue-700 text-xs font-bold rounded-full">{{ $package->badge }}</span>@endif
        </div>
      </div>
      <div class="p-5">
        <div class="flex items-center justify-between mb-2">
          <h3 class="font-heading font-bold text-lg text-gray-900">{{ $package->name }}</h3>
        </div>
        <p class="text-gray-500 text-sm mb-1">Harga: <span class="font-semibold text-gray-800">{{ $package->price ?? 'Custom' }}</span></p>
        <p class="text-gray-400 text-xs mb-4">Urutan: {{ $package->sort }} · {{ $package->itineraries()->count() }} itinerary · {{ $package->pricingTiers()->count() }} harga · {{ $package->gallery()->count() }} galeri</p>
        <div class="flex items-center gap-2">
          <a href="{{ route('admin.packages.edit', $package) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">Edit</a>
          <a href="{{ route('package.show', $package) }}" target="_blank" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-colors">Lihat</a>
          <form method="POST" action="{{ route('admin.packages.destroy', $package) }}" onsubmit="return confirm('Hapus paket ini beserta seluruh kontennya?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 text-sm font-semibold rounded-lg hover:bg-red-100 transition-colors">Hapus</button>
          </form>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-2xl p-8 text-center text-gray-400 border border-gray-100">Belum ada paket wisata.</div>
    @endforelse
  </div>
@endsection

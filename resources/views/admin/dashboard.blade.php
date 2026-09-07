@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
  <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @php
      $stats = [
        ['Paket Wisata', $packageCount, route('admin.packages.index'), 'from-blue-500 to-blue-700'],
        ['Destinasi', $destinationCount, route('admin.destinasi.index'), 'from-green-500 to-emerald-600'],
        ['Kuliner', $kulinerCount, route('admin.kuliner.index'), 'from-orange-400 to-orange-600'],
        ['Shopping', $shoppingCount, route('admin.shopping.index'), 'from-purple-500 to-indigo-600'],
        ['Testimoni', $testimonialCount, route('admin.testimonials.index'), 'from-pink-500 to-rose-600'],
      ];
    @endphp
    @foreach ($stats as [$label, $count, $url, $gradient])
    <a href="{{ $url }}" class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
      <div class="w-11 h-11 rounded-xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center mb-3"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg></div>
      <p class="font-heading font-extrabold text-2xl text-gray-900">{{ $count }}</p>
      <p class="text-gray-500 text-sm">{{ $label }}</p>
    </a>
    @endforeach
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
      <h2 class="font-heading font-bold text-lg text-gray-900">Paket Wisata</h2>
      <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">+ Tambah Paket</a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 border-b border-gray-100">
            <th class="px-6 py-3 font-medium">Nama</th>
            <th class="px-6 py-3 font-medium">Harga</th>
            <th class="px-6 py-3 font-medium">Best Seller</th>
            <th class="px-6 py-3 font-medium">Status</th>
            <th class="px-6 py-3 font-medium text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          @forelse ($packages as $package)
          <tr>
            <td class="px-6 py-3 font-medium text-gray-900">{{ $package->name }}</td>
            <td class="px-6 py-3 text-gray-600">{{ $package->price ?? '-' }}</td>
            <td class="px-6 py-3">@if($package->is_best_seller)<span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">Ya</span>@else<span class="text-gray-400 text-xs">-</span>@endif</td>
            <td class="px-6 py-3">@if($package->active)<span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Aktif</span>@else<span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-xs font-semibold rounded-full">Nonaktif</span>@endif</td>
            <td class="px-6 py-3 text-right">
              <a href="{{ route('admin.packages.edit', $package) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
            </td>
          </tr>
          @empty
          <tr><td colspan="5" class="px-6 py-6 text-center text-gray-400">Belum ada paket.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

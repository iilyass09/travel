@extends('layouts.admin')

@section('title', 'Destinasi')
@section('header', 'Destinasi Wisata')

@section('content')
  <div class="mb-6 flex justify-end">
    <a href="{{ route('admin.destinasi.create') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">+ Tambah Destinasi</a>
  </div>

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse ($items as $item)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="relative aspect-square bg-gradient-to-br {{ $item->gradient }}">
        @if ($item->imageUrl())
          <img src="{{ $item->imageUrl() }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        @endif
        <div class="absolute bottom-0 inset-x-0 p-3 bg-gradient-to-t from-black/50 to-transparent">
          <p class="text-white font-heading font-bold">{{ $item->name }}</p>
        </div>
        <div class="absolute top-2 right-2 px-2 py-0.5 bg-black/40 text-white text-xs rounded-full">{{ $item->category }}</div>
        @if(!$item->active)<div class="absolute top-2 left-2 px-2 py-0.5 bg-gray-500 text-white text-xs rounded-full">Nonaktif</div>@endif
      </div>
      <div class="p-3 flex items-center justify-between">
        <span class="text-gray-400 text-xs">Urutan: {{ $item->sort }}</span>
        <div class="flex gap-2">
          <a href="{{ route('admin.destinasi.edit', $item) }}" class="px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">Edit</a>
          <form method="POST" action="{{ route('admin.destinasi.destroy', $item) }}" onsubmit="return confirm('Hapus destinasi ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
          </form>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-2xl p-8 text-center text-gray-400 border border-gray-100">Belum ada destinasi.</div>
    @endforelse
  </div>
@endsection

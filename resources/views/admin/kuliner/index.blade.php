@extends('layouts.admin')

@section('title', 'Kuliner')
@section('header', 'Spot Kuliner')

@section('content')
  <div class="mb-6 flex justify-end">
    <a href="{{ route('admin.kuliner.create') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">+ Tambah Kuliner</a>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($items as $item)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
      <div class="flex items-start gap-3 mb-2">
        <div class="w-12 h-12 bg-gradient-to-br {{ $item->gradient }} rounded-xl flex items-center justify-center flex-shrink-0"></div>
        <div>
          <h3 class="font-heading font-bold text-gray-900">{{ $item->name }}</h3>
          @if(!$item->active)<span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-xs font-semibold rounded-full">Nonaktif</span>@endif
        </div>
      </div>
      <p class="text-gray-500 text-sm line-clamp-2 mb-2">{{ $item->description }}</p>
      <p class="text-gray-400 text-xs mb-3">Urutan: {{ $item->sort }}</p>
      <div class="flex gap-2">
        <a href="{{ route('admin.kuliner.edit', $item) }}" class="px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">Edit</a>
        <form method="POST" action="{{ route('admin.kuliner.destroy', $item) }}" onsubmit="return confirm('Hapus spot kuliner ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
        </form>
      </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-2xl p-8 text-center text-gray-400 border border-gray-100">Belum ada spot kuliner.</div>
    @endforelse
  </div>
@endsection

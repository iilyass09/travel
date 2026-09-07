@extends('layouts.admin')

@section('title', 'Testimoni')
@section('header', 'Testimoni')

@section('content')
  <div class="mb-6 flex justify-end">
    <a href="{{ route('admin.testimonials.create') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">+ Tambah Testimoni</a>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left text-gray-500 border-b border-gray-100">
          <th class="px-6 py-3 font-medium">Nama</th>
          <th class="px-6 py-3 font-medium">Paket</th>
          <th class="px-6 py-3 font-medium">Rating</th>
          <th class="px-6 py-3 font-medium text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse ($items as $item)
        <tr>
          <td class="px-6 py-3 font-medium text-gray-900">{{ $item->name }}</td>
          <td class="px-6 py-3 text-gray-600">{{ $item->package ? $item->package->name : '-' }}</td>
          <td class="px-6 py-3 text-yellow-500">{{ str_repeat('★', $item->rating) }}{{ str_repeat('☆', 5 - $item->rating) }}</td>
          <td class="px-6 py-3 text-right space-x-2">
            <a href="{{ route('admin.testimonials.edit', $item) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus testimoni ini?')">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="px-6 py-6 text-center text-gray-400">Belum ada testimoni.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection

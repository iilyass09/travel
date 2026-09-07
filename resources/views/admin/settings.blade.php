@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('header', 'Pengaturan Website')

@section('content')
  <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-8">
      @foreach ($groups as $groupKey => $groupLabel)
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
          <h2 class="font-heading font-bold text-gray-900">{{ $groupLabel }}</h2>
        </div>
        <div class="p-6 grid md:grid-cols-2 gap-5">
          @foreach ($fields as [$fieldGroup, $key, $label, $type])
            @if ($fieldGroup === $groupKey)
              @if ($type === 'file')
              <div>
                <label for="{{ $key }}" class="block text-sm font-medium text-gray-700 mb-1.5">{{ $label }}</label>
                @if (!empty($values[$key]) && $values[$key] && \Illuminate\Support\Facades\Storage::disk('public')->exists($values[$key]))
                  <div class="mb-2">
                    <img src="{{ storage_url($values[$key]) }}" alt="Preview" class="w-48 h-36 object-cover rounded-xl border border-gray-200">
                  </div>
                @endif
                <input type="file" id="{{ $key }}" name="{{ $key }}" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100">
                <p class="text-xs text-gray-400 mt-1">Biarkan kosong untuk mempertahankan foto saat ini.</p>
              </div>
              @else
                <x-admin.field :name="$key" :label="$label" :type="$type" :value="$values[$key] ?? ''" />
              @endif
            @endif
          @endforeach
        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-8 flex justify-end">
      <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-lg shadow-orange-500/30">Simpan Pengaturan</button>
    </div>
  </form>
@endsection

@extends('layouts.admin')

@section('title', $item ? 'Edit Destinasi' : 'Tambah Destinasi')
@section('header', $item ? 'Edit Destinasi: ' . $item->name : 'Tambah Destinasi')

@section('content')
  @php $isEdit = $item !== null; @endphp
  <form method="POST" action="{{ $isEdit ? route('admin.destinasi.update', $item) : route('admin.destinasi.store') }}" enctype="multipart/form-data" class="max-w-3xl bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-5">
      <x-admin.field name="name" label="Nama Destinasi *" value="{{ $isEdit ? $item->name : old('name') }}" placeholder="cth. Lembang" />
      <x-admin.select name="category" label="Kategori" value="{{ $isEdit ? $item->category : old('category', 'alami') }}" :options="['alami'=>'Alami','kota'=>'Kota','wisata'=>'Wisata Populer']" />
      <x-admin.field name="gradient" label="Gradient" value="{{ $isEdit ? $item->gradient : old('gradient', 'from-green-500 to-emerald-700') }}" placeholder="from-green-500 to-emerald-700" />
      <x-admin.field name="sort" label="Urutan" value="{{ $isEdit ? $item->sort : old('sort', 0) }}" />
    </div>

    <div class="mt-5">
      <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar (opsional)</label>
      @if ($isEdit && $item->imageUrl())
        <div class="mb-2"><img src="{{ $item->imageUrl() }}" alt="" class="w-40 h-40 object-cover rounded-xl"></div>
      @endif
      <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100">
    </div>

    @if ($isEdit)
    <div class="mt-5">
      <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="active" @checked($item->active) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Aktif (tampil di website)</label>
    </div>
    @endif

    @if ($errors->any())
    <div class="mt-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">{{ $errors->first() }}</div>
    @endif

    <div class="mt-6 flex gap-3 justify-end">
      <a href="{{ route('admin.destinasi.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
      <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg shadow-blue-300">{{ $isEdit ? 'Simpan' : 'Tambah' }}</button>
    </div>
  </form>
@endsection

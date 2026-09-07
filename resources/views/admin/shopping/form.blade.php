@extends('layouts.admin')

@section('title', $item ? 'Edit Shopping' : 'Tambah Shopping')
@section('header', $item ? 'Edit Shopping: ' . $item->name : 'Tambah Shopping')

@section('content')
  @php $isEdit = $item !== null; @endphp
  <form method="POST" action="{{ $isEdit ? route('admin.shopping.update', $item) : route('admin.shopping.store') }}" class="max-w-3xl bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-5">
      <x-admin.field name="name" label="Nama *" value="{{ $isEdit ? $item->name : old('name') }}" placeholder="cth. Pasar Baru" />
      <x-admin.field name="gradient" label="Gradient" value="{{ $isEdit ? $item->gradient : old('gradient', 'from-purple-500 to-indigo-600') }}" placeholder="from-purple-500 to-indigo-600" />
      <x-admin.field name="icon_light" label="Kelas Warna Ikon" value="{{ $isEdit ? $item->icon_light : old('icon_light', 'text-orange-300') }}" placeholder="text-orange-300" />
      <x-admin.field name="sort" label="Urutan" value="{{ $isEdit ? $item->sort : old('sort', 0) }}" />
      <div class="md:col-span-2"><x-admin.field type="textarea" name="description" label="Deskripsi *" value="{{ $isEdit ? $item->description : old('description') }}" /></div>
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
      <a href="{{ route('admin.shopping.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
      <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg shadow-blue-300">{{ $isEdit ? 'Simpan' : 'Tambah' }}</button>
    </div>
  </form>
@endsection

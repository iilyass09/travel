@extends('layouts.admin')

@section('title', $item ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('header', $item ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
  @php $isEdit = $item !== null; @endphp
  <form method="POST" action="{{ $isEdit ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}" class="max-w-3xl bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-5">
      <x-admin.field name="name" label="Nama *" value="{{ $isEdit ? $item->name : old('name') }}" />
      <x-admin.field name="role" label="Peran/Pekerjaan" value="{{ $isEdit ? $item->role : old('role') }}" placeholder="cth. Wisata Keluarga" />
      <div>
        <label for="package_id" class="block text-sm font-medium text-gray-700 mb-1.5">Paket Terkait (opsional)</label>
        <select id="package_id" name="package_id" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
          <option value="">— Tanpa paket —</option>
          @foreach ($packages as $pkg)
          <option value="{{ $pkg->id }}" @selected($isEdit ? $item->package_id == $pkg->id : old('package_id') == $pkg->id)>{{ $pkg->name }}</option>
          @endforeach
        </select>
      </div>
      <x-admin.select name="rating" label="Rating" value="{{ $isEdit ? $item->rating : old('rating', 5) }}" :options="[5=>'5 ★',4=>'4 ★',3=>'3 ★',2=>'2 ★',1=>'1 ★']" />
      <x-admin.field name="avatar_gradient" label="Gradient Avatar" value="{{ $isEdit ? $item->avatar_gradient : old('avatar_gradient', 'from-blue-500 to-blue-700') }}" placeholder="from-blue-500 to-blue-700" />
      <div class="md:col-span-2"><x-admin.field type="textarea" name="text" label="Isi Testimoni *" value="{{ $isEdit ? $item->text : old('text') }}" rows="5" /></div>
    </div>

    @if ($errors->any())
    <div class="mt-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">{{ $errors->first() }}</div>
    @endif

    <div class="mt-6 flex gap-3 justify-end">
      <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
      <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg shadow-blue-300">{{ $isEdit ? 'Simpan' : 'Tambah' }}</button>
    </div>
  </form>
@endsection

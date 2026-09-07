@extends('layouts.admin')

@section('title', $package ? 'Edit ' . $package->name : 'Tambah Paket')
@section('header', $package ? 'Edit Paket: ' . $package->name : 'Tambah Paket')

@push('head')
<style>
    .admin-tab.active { background: #1e40af; color: #fff; }
    .nested-collapse { display: none; }
</style>
@endpush

@section('content')
  @php $isEdit = $package !== null; @endphp

  @if ($isEdit)
    <div class="flex gap-2 mb-6 flex-wrap">
      <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-colors">← Semua Paket</a>
      <a href="{{ route('package.show', $package) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">Lihat Halaman Publik</a>
    </div>
  @endif

  <div class="mb-6 flex gap-2 flex-wrap">
    <button type="button" class="admin-tab active px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="detail">Detail</button>
    @if ($isEdit)
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-itinerary">Itinerary</button>
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-harga">Harga</button>
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-fasilitas">Fasilitas</button>
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-galeri">Galeri</button>
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-testimoni">Testimoni</button>
    <button type="button" class="admin-tab px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold transition-colors hover:bg-gray-200" data-tab="tab-faq">FAQ</button>
    @endif
  </div>

  {{-- ========== DETAIL TAB ========== --}}
  <form id="tab-detail" method="POST" action="{{ $isEdit ? route('admin.packages.update', $package) : route('admin.packages.store') }}" enctype="multipart/form-data" class="admin-panel-block">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Detail Paket</h2>
      <div class="grid md:grid-cols-2 gap-5">
        <x-admin.field name="name" label="Nama Paket *" value="{{ $isEdit ? $package->name : old('name') }}" placeholder="cth. Lembang" />
        <x-admin.field name="category" label="Kategori" value="{{ $isEdit ? $package->category : old('category') }}" placeholder="cth. CITY TOUR" />
        <x-admin.field name="badge" label="Badge Kartu" value="{{ $isEdit ? $package->badge : old('badge') }}" placeholder="cth. BEST SELLER / POPULER / FAVORIT" />
        <div class="grid grid-cols-2 gap-3">
          <x-admin.field name="badge_dot_class" label="Warna Dot Badge" value="{{ $isEdit ? $package->badge_dot_class : old('badge_dot_class') }}" placeholder="bg-green-400" />
          <x-admin.field name="badge_text_class" label="Kelas Teks Badge" value="{{ $isEdit ? $package->badge_text_class : old('badge_text_class') }}" placeholder="text-green-700" />
        </div>
        <x-admin.field name="price" label="Harga Mulai" value="{{ $isEdit ? $package->price : old('price') }}" placeholder="cth. Rp 600.000" />
        <x-admin.field name="price_compare" label="Harga Coret (opsional)" value="{{ $isEdit ? $package->price_compare : old('price_compare') }}" placeholder="cth. Rp 850.000" />
        <x-admin.field name="duration" label="Durasi" value="{{ $isEdit ? $package->duration : old('duration') }}" placeholder="±10 Jam" />
        <x-admin.field name="seat_count" label="Jumlah Kursi" value="{{ $isEdit ? $package->seat_count : old('seat_count') }}" placeholder="7 Seat" />
        <x-admin.field name="seat_note" label="Tipe Kendaraan" value="{{ $isEdit ? $package->seat_note : old('seat_note') }}" placeholder="Calya / Sigra" />
      </div>

      <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline (deskripsi singkat di hero detail)</label>
        <textarea name="tagline" rows="3" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ $isEdit ? $package->tagline : old('tagline') }}</textarea>
      </div>
      <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat (kartu)</label>
        <textarea name="short_desc" rows="2" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ $isEdit ? $package->short_desc : old('short_desc') }}</textarea>
      </div>
      <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Lengkap</label>
        <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ $isEdit ? $package->description : old('description') }}</textarea>
      </div>
      <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description (SEO)</label>
        <textarea name="meta_description" rows="2" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ $isEdit ? $package->meta_description : old('meta_description') }}</textarea>
      </div>

      <div class="mt-5 grid md:grid-cols-2 gap-5">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Cover (opsional)</label>
          @if ($isEdit && $package->image)
            <div class="mb-2"><img src="{{ $package->coverUrl() }}" alt="" class="w-40 h-28 object-cover rounded-xl"></div>
          @endif
          <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Gradient Kartu</label>
          <div class="flex flex-wrap gap-2 mb-3">
            @foreach ($presets as $preset)
            <button type="button" class="gradient-pick w-9 h-9 rounded-lg bg-gradient-to-br {{ $preset }} @if(($isEdit ? $package->card_gradient : old('card_gradient', 'from-green-400 to-emerald-600')) === $preset) ring-2 ring-offset-2 ring-blue-500 @endif" data-value="{{ $preset }}" data-field="card_gradient"></button>
            @endforeach
          </div>
          <input type="text" id="card_gradient" name="card_gradient" value="{{ $isEdit ? $package->card_gradient : old('card_gradient', 'from-green-400 to-emerald-600') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>
      </div>

      <div class="mt-5 grid md:grid-cols-3 gap-5">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Gradient Halaman Detail</label>
          <input type="text" name="detail_gradient" value="{{ $isEdit ? $package->detail_gradient : old('detail_gradient', 'from-blue-900 via-blue-800 to-emerald-900') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan (sort)</label>
          <input type="number" name="sort" value="{{ $isEdit ? $package->sort : old('sort', 0) }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>
        <div class="space-y-3 pt-6">
          <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_best_seller" @checked($isEdit ? $package->is_best_seller : old('is_best_seller')) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Tandai Best Seller</label>
          <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="active" @checked($isEdit ? $package->active : old('active', 1)) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Aktif (tampil di website)</label>
        </div>
      </div>

      @if ($errors->any())
      <div class="mt-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-xl">{{ $errors->first() }}</div>
      @endif

      <div class="mt-6 flex gap-3 justify-end">
        <a href="{{ route('admin.packages.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg shadow-blue-300">{{ $isEdit ? 'Simpan Perubahan' : 'Buat Paket' }}</button>
      </div>
    </div>
  </form>

  @if ($isEdit)
  {{-- ========== ITINERARY TAB ========== --}}
  <div id="tab-itinerary" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Itinerary</h2>
      @forelse ($package->itineraries as $it)
      <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-2">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-1">
            <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">{{ $it->time }}</span>
            <span class="text-gray-400 text-xs">{{ $it->label }}</span>
            <span class="font-semibold text-gray-800 text-sm">{{ $it->title }}</span>
          </div>
          <p class="text-gray-500 text-xs">{{ $it->description }}</p>
        </div>
        <button type="button" class="edit-nested px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" data-target="#edit-it-{{ $it->id }}">Edit</button>
        <form method="POST" action="{{ route('admin.itinerary.destroy', $it) }}" onsubmit="return confirm('Hapus itinerary ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
        </form>
      </div>

      <div id="edit-it-{{ $it->id }}" class="nested-collapse p-4 mb-4 bg-white border border-blue-200 rounded-xl">
        <form method="POST" action="{{ route('admin.itinerary.update', $it) }}" class="grid md:grid-cols-2 gap-4">
          @csrf @method('PUT')
          <x-admin.field name="time" label="Waktu" value="{{ $it->time }}" placeholder="06.30" />
          <x-admin.field name="label" label="Label" value="{{ $it->label }}" placeholder="Start / Destinasi 1 / Pulang" />
          <x-admin.field name="title" label="Judul" value="{{ $it->title }}" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="description" label="Deskripsi" value="{{ $it->description }}" /></div>
          <div class="md:col-span-2 flex gap-3 justify-end">
            <button type="button" class="cancel-nested px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
      @empty
      <p class="text-gray-400 text-sm">Belum ada itinerary.</p>
      @endforelse

      <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah Itinerary</h3>
        <form method="POST" action="{{ route('admin.packages.itinerary.store', $package) }}" class="grid md:grid-cols-2 gap-4">
          @csrf
          <x-admin.field name="time" label="Waktu *" placeholder="06.30" />
          <x-admin.field name="label" label="Label" placeholder="Start / Destinasi 1 / Pulang" />
          <x-admin.field name="title" label="Judul *" placeholder="cth. Tangkuban Perahu" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="description" label="Deskripsi" /></div>
          <div class="md:col-span-2 flex justify-end"><button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>

  {{-- ========== HARGA TAB ========== --}}
  <div id="tab-harga" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Pilihan Harga</h2>
      @forelse ($package->pricingTiers as $tier)
      <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-2">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-1">
            @if($tier->badge)<span class="px-2 py-0.5 {{ $tier->badge_class }} text-white text-xs font-bold rounded-full">{{ $tier->badge }}</span>@endif
            <span class="font-semibold text-gray-800 text-sm">{{ $tier->name }}</span>
            <span class="text-blue-700 font-bold text-sm">{{ $tier->price }}</span>
          </div>
          <p class="text-gray-500 text-xs">{{ $tier->subtitle }}</p>
        </div>
        <button type="button" class="edit-nested px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" data-target="#edit-price-{{ $tier->id }}">Edit</button>
        <form method="POST" action="{{ route('admin.pricing.destroy', $tier) }}" onsubmit="return confirm('Hapus pilihan harga ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
        </form>
      </div>

      <div id="edit-price-{{ $tier->id }}" class="nested-collapse p-4 mb-4 bg-white border border-blue-200 rounded-xl">
        <form method="POST" action="{{ route('admin.pricing.update', $tier) }}" class="grid md:grid-cols-2 gap-4">
          @csrf @method('PUT')
          <x-admin.field name="name" label="Nama Paket" value="{{ $tier->name }}" />
          <x-admin.field name="badge" label="Badge" value="{{ $tier->badge }}" placeholder="PALING LARIS" />
          <x-admin.field name="badge_class" label="Kelas Badge" value="{{ $tier->badge_class }}" placeholder="bg-blue-600" />
          <x-admin.field name="subtitle" label="Subjudul" value="{{ $tier->subtitle }}" />
          <x-admin.field name="price" label="Harga" value="{{ $tier->price }}" />
          <x-admin.field name="price_compare" label="Harga Coret" value="{{ $tier->price_compare }}" />
          <x-admin.field name="note" label="Catatan (bila harga Custom)" value="{{ $tier->note }}" />
          <x-admin.field name="button_text" label="Teks Tombol" value="{{ $tier->button_text }}" />
          <x-admin.field name="button_class" label="Kelas Tombol" value="{{ $tier->button_class }}" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="features" label="Fitur (satu per baris)" value="{{ $tier->features }}" rows="5" /></div>
          <div class="md:col-span-2 flex gap-3 justify-end">
            <button type="button" class="cancel-nested px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
      @empty
      <p class="text-gray-400 text-sm">Belum ada pilihan harga.</p>
      @endforelse

      <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah Pilihan Harga</h3>
        <form method="POST" action="{{ route('admin.packages.pricing.store', $package) }}" class="grid md:grid-cols-2 gap-4">
          @csrf
          <x-admin.field name="name" label="Nama Paket *" placeholder="Paket Hemat" />
          <x-admin.field name="badge" label="Badge" placeholder="PALING LARIS" />
          <x-admin.field name="badge_class" label="Kelas Badge" value="bg-blue-600" placeholder="bg-blue-600" />
          <x-admin.field name="subtitle" label="Subjudul" placeholder="Cocok untuk 2-3 orang" />
          <x-admin.field name="price" label="Harga *" placeholder="Rp 600.000" />
          <x-admin.field name="price_compare" label="Harga Coret" placeholder="Rp 850.000" />
          <x-admin.field name="note" label="Catatan (bila Custom)" placeholder="Sesuai jumlah objek wisata" />
          <x-admin.field name="button_text" label="Teks Tombol" placeholder="Pilih Paket" />
          <x-admin.field name="button_class" label="Kelas Tombol" placeholder="bg-gradient-to-r from-blue-600 to-blue-700" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="features" label="Fitur (satu per baris)" rows="5" placeholder="Mobil + Driver + BBM" /></div>
          <div class="md:col-span-2 flex justify-end"><button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>

  {{-- ========== FASILITAS TAB ========== --}}
  <div id="tab-fasilitas" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Fasilitas (Termasuk / Tidak Termasuk)</h2>
      @foreach (['included' => 'Sudah Termasuk', 'excluded' => 'Tidak Termasuk'] as $type => $title)
      <h3 class="font-semibold text-gray-800 mb-2 mt-4 {{ $type === 'included' ? 'text-emerald-600' : 'text-red-500' }}">{{ $title }}</h3>
      @foreach ($package->facility->where('type', $type) as $f)
      <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-2">
        <div class="flex-1 text-sm text-gray-700">• {{ $f->text }}</div>
        <button type="button" class="edit-nested px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" data-target="#edit-fac-{{ $f->id }}">Edit</button>
        <form method="POST" action="{{ route('admin.facility.destroy', $f) }}" onsubmit="return confirm('Hapus fasilitas ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
        </form>
      </div>

      <div id="edit-fac-{{ $f->id }}" class="nested-collapse p-4 mb-4 bg-white border border-blue-200 rounded-xl">
        <form method="POST" action="{{ route('admin.facility.update', $f) }}" class="grid md:grid-cols-2 gap-4">
          @csrf @method('PUT')
          <x-admin.select name="type" label="Tipe" value="{{ $f->type }}" :options="['included' => 'Sudah Termasuk', 'excluded' => 'Tidak Termasuk']" />
          <div class="md:col-span-2"><x-admin.field name="text" label="Teks" value="{{ $f->text }}" /></div>
          <div class="md:col-span-2 flex gap-3 justify-end">
            <button type="button" class="cancel-nested px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
      @endforeach
      @endforeach

      <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah Fasilitas</h3>
        <form method="POST" action="{{ route('admin.packages.facility.store', $package) }}" class="grid md:grid-cols-2 gap-4">
          @csrf
          <x-admin.select name="type" label="Tipe" :options="['included' => 'Sudah Termasuk', 'excluded' => 'Tidak Termasuk']" />
          <x-admin.field name="text" label="Teks *" placeholder="cth. Mobil Calya / Sigra + Driver profesional" />
          <div class="md:col-span-2 flex justify-end"><button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>

  {{-- ========== GALERI TAB ========== --}}
  <div id="tab-galeri" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Galeri</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @forelse ($package->gallery as $img)
        <div class="relative group rounded-2xl overflow-hidden aspect-square bg-gradient-to-br {{ $img->gradient }}">
          @if ($img->image)
            <img src="{{ $img->url() }}" alt="" class="w-full h-full object-cover">
          @endif
          <div class="absolute bottom-0 inset-x-0 p-2 bg-gradient-to-t from-black/60 to-transparent">
            <p class="text-white text-xs font-semibold">{{ $img->caption }}</p>
          </div>
          <form method="POST" action="{{ route('admin.gallery.destroy', $img) }}" class="absolute top-2 right-2" onsubmit="return confirm('Hapus gambar ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="w-7 h-7 rounded-full bg-red-500 text-white text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">✕</button>
          </form>
        </div>
        @empty
        <p class="col-span-full text-gray-400 text-sm">Belum ada gambar galeri.</p>
        @endforelse
      </div>

      <div class="border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah Gambar Galeri</h3>
        <form method="POST" action="{{ route('admin.packages.gallery.store', $package) }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar (opsional, tanpa gambar pakai gradient)</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100">
          </div>
          <x-admin.field name="gradient" label="Gradient" value="from-green-500 to-emerald-700" placeholder="from-green-500 to-emerald-700" />
          <x-admin.field name="caption" label="Caption" placeholder="cth. Tangkuban Perahu" />
          <div class="flex items-end justify-end"><button type="submit" class="px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>

  {{-- ========== TESTIMONI TAB ========== --}}
  <div id="tab-testimoni" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">Testimoni Paket Ini</h2>
      @forelse ($package->testimonials as $t)
      <div class="p-3 bg-gray-50 rounded-xl mb-2">
        <div class="flex items-center gap-3">
          <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
              <span class="font-semibold text-gray-800 text-sm">{{ $t->name }}</span>
              <span class="text-yellow-500 text-xs">{{ $t->stars() }}</span>
              <span class="text-gray-400 text-xs">{{ $t->role }}</span>
            </div>
            <p class="text-gray-500 text-xs">"{{ $t->text }}"</p>
          </div>
          <button type="button" class="edit-nested px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" data-target="#edit-test-{{ $t->id }}">Edit</button>
          <form method="POST" action="{{ route('admin.testimonial.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
          </form>
        </div>
      </div>

      <div id="edit-test-{{ $t->id }}" class="nested-collapse p-4 mb-4 bg-white border border-blue-200 rounded-xl">
        <form method="POST" action="{{ route('admin.testimonial.update', $t) }}" class="grid md:grid-cols-2 gap-4">
          @csrf @method('PUT')
          <x-admin.field name="name" label="Nama" value="{{ $t->name }}" />
          <x-admin.field name="role" label="Peran/Pekerjaan" value="{{ $t->role }}" />
          <x-admin.field name="avatar_gradient" label="Gradient Avatar" value="{{ $t->avatar_gradient }}" placeholder="from-blue-500 to-blue-700" />
          <x-admin.select name="rating" label="Rating" value="{{ $t->rating }}" :options="[5=>'5 ★',4=>'4 ★',3=>'3 ★',2=>'2 ★',1=>'1 ★']" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="text" label="Isi Testimoni" value="{{ $t->text }}" rows="4" /></div>
          <div class="md:col-span-2 flex gap-3 justify-end">
            <button type="button" class="cancel-nested px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
      @empty
      <p class="text-gray-400 text-sm">Belum ada testimoni.</p>
      @endforelse

      <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah Testimoni</h3>
        <form method="POST" action="{{ route('admin.packages.testimonial.store', $package) }}" class="grid md:grid-cols-2 gap-4">
          @csrf
          <x-admin.field name="name" label="Nama *" />
          <x-admin.field name="role" label="Peran/Pekerjaan" placeholder="cth. Wisata Keluarga" />
          <x-admin.field name="avatar_gradient" label="Gradient Avatar" value="from-blue-500 to-blue-700" />
          <x-admin.select name="rating" label="Rating" value="5" :options="[5=>'5 ★',4=>'4 ★',3=>'3 ★',2=>'2 ★',1=>'1 ★']" />
          <div class="md:col-span-2"><x-admin.field type="textarea" name="text" label="Isi Testimoni *" rows="4" /></div>
          <div class="md:col-span-2 flex justify-end"><button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>

  {{-- ========== FAQ TAB ========== --}}
  <div id="tab-faq" class="admin-panel-block nested-collapse">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <h2 class="font-heading font-bold text-lg text-gray-900 mb-4">FAQ</h2>
      @forelse ($package->faqs as $faq)
      <div class="p-3 bg-gray-50 rounded-xl mb-2">
        <div class="flex items-center gap-3">
          <div class="flex-1">
            <p class="font-semibold text-gray-800 text-sm mb-1">{{ $faq->question }}</p>
            <p class="text-gray-500 text-xs">{{ $faq->answer }}</p>
          </div>
          <button type="button" class="edit-nested px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200" data-target="#edit-faq-{{ $faq->id }}">Edit</button>
          <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}" onsubmit="return confirm('Hapus FAQ ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-3 py-1.5 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Hapus</button>
          </form>
        </div>
      </div>

      <div id="edit-faq-{{ $faq->id }}" class="nested-collapse p-4 mb-4 bg-white border border-blue-200 rounded-xl">
        <form method="POST" action="{{ route('admin.faq.update', $faq) }}" class="grid gap-4">
          @csrf @method('PUT')
          <x-admin.field name="question" label="Pertanyaan" value="{{ $faq->question }}" />
          <x-admin.field type="textarea" name="answer" label="Jawaban" value="{{ $faq->answer }}" rows="4" />
          <div class="flex gap-3 justify-end">
            <button type="button" class="cancel-nested px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
      @empty
      <p class="text-gray-400 text-sm">Belum ada FAQ.</p>
      @endforelse

      <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="font-semibold text-gray-800 mb-3">Tambah FAQ</h3>
        <form method="POST" action="{{ route('admin.packages.faq.store', $package) }}" class="grid gap-4">
          @csrf
          <x-admin.field name="question" label="Pertanyaan *" />
          <x-admin.field type="textarea" name="answer" label="Jawaban *" rows="4" />
          <div class="flex justify-end"><button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">Tambah</button></div>
        </form>
      </div>
    </div>
  </div>
  @endif

@endsection

@push('scripts')
<script>
  // Tab switching
  document.querySelectorAll('.admin-tab').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openTab(btn.getAttribute('data-tab'));
    });
  });

  function openTab(tabId) {
    document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.admin-panel-block').forEach(p => p.classList.add('nested-collapse'));
    const tabBtn = document.querySelector('.admin-tab[data-tab="' + tabId + '"]');
    if (tabBtn) tabBtn.classList.add('active');
    const target = document.getElementById(tabId);
    if (target) target.classList.remove('nested-collapse');
  }

  if (location.hash) {
    openTab(location.hash.replace('#', ''));
    setTimeout(function(){ document.getElementById(location.hash.replace('#',''))?.scrollIntoView({behavior:'smooth'}); }, 50);
  }

  // Nested edit/cancel
  document.querySelectorAll('.edit-nested').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelector(btn.getAttribute('data-target')).classList.toggle('nested-collapse');
    });
  });
  document.querySelectorAll('.cancel-nested').forEach(function (btn) {
    btn.addEventListener('click', function () {
      btn.closest('.nested-collapse') || btn.closest('div[class*="edit-"]');
      let collapse = btn.closest('.admin-panel-block') ? null : btn;
      const parent = btn.closest('.p-4');
      if (parent) parent.classList.add('nested-collapse');
    });
  });

  // Gradient pickers for card_gradient on detail tab
  document.querySelectorAll('.gradient-pick').forEach(function (pick) {
    pick.addEventListener('click', function () {
      const field = document.getElementById(pick.getAttribute('data-field'));
      if (field) { field.value = pick.getAttribute('data-value'); }
      document.querySelectorAll('.gradient-pick').forEach(p => p.classList.remove('ring-2', 'ring-offset-2', 'ring-blue-500'));
      pick.classList.add('ring-2', 'ring-offset-2', 'ring-blue-500');
    });
  });
</script>
@endpush

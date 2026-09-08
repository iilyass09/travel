<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FacilityItem;
use App\Models\ItineraryItem;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PricingTier;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PackageController extends Controller
{
    private array $presets = [
        'from-green-400 to-emerald-600',
        'from-blue-400 to-cyan-600',
        'from-emerald-400 to-teal-600',
        'from-purple-500 to-indigo-700',
        'from-orange-400 to-red-500',
        'from-pink-500 to-rose-600',
        'from-cyan-500 to-blue-700',
        'from-gray-700 to-gray-900',
    ];

    public function index(): View
    {
        return view('admin.packages.index', ['packages' => Package::orderBy('sort')->get()]);
    }

    public function create(): View
    {
        return view('admin.packages.form', ['package' => null, 'presets' => $this->presets]);
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.form', [
            'package' => $package->load('itineraries', 'pricingTiers', 'included', 'excluded', 'faqs', 'gallery', 'testimonials'),
            'presets' => $this->presets,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['sort'] = (int) ($request->input('sort', 0));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages/' . $data['slug'], 'public');
        }

        $package = Package::create($data);

        return redirect()->route('admin.packages.edit', $package)->with('success', 'Paket berhasil dibuat.');
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_best_seller'] = $request->boolean('is_best_seller');
        $data['active'] = $request->boolean('active');
        $data['sort'] = (int) ($request->input('sort', $package->sort));

        if (($data['name'] ?? '') !== '' && $data['name'] !== $package->name) {
            $data['slug'] = $this->uniqueSlug($data['name'], $package->id);
        }

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $data['image'] = $request->file('image')->store('packages/' . $package->fresh()['slug'], 'public');
        }

        $package->update($data);

        return redirect()->route('admin.packages.edit', $package)->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
        foreach ($package->images as $img) {
            if ($img->image) {
                Storage::disk('public')->delete($img->image);
            }
        }
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'short_desc' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'badge' => ['nullable', 'string', 'max:100'],
            'badge_dot_class' => ['nullable', 'string', 'max:100'],
            'badge_text_class' => ['nullable', 'string', 'max:100'],
            'card_gradient' => ['required', 'string', 'max:200'],
            'detail_gradient' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:100'],
            'seat_count' => ['nullable', 'string', 'max:100'],
            'seat_note' => ['nullable', 'string', 'max:100'],
            'price' => ['nullable', 'string', 'max:100'],
            'price_compare' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignore = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (Package::where('slug', $slug)->where('id', '!=', $ignore)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    // ---- Itinerary ----

    public function storeItinerary(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            'time' => ['required', 'string', 'max:50'],
            'label' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
        $data['sort'] = $package->itineraries()->count();

        $package->itineraries()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-itinerary')->with('success', 'Itinerary ditambahkan.');
    }

    public function updateItinerary(Request $request, ItineraryItem $itinerary): RedirectResponse
    {
        $itinerary->update($request->validate([
            'time' => ['required', 'string', 'max:50'],
            'label' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]));

        return redirect()->route('admin.packages.edit', $itinerary->package)->withFragment('tab-itinerary')->with('success', 'Itinerary diperbarui.');
    }

    public function destroyItinerary(ItineraryItem $itinerary): RedirectResponse
    {
        $package = $itinerary->package;
        $itinerary->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-itinerary')->with('success', 'Itinerary dihapus.');
    }

    // ---- Pricing ----

    public function storePricing(Request $request, Package $package): RedirectResponse
    {
        $data = $this->pricingData($request);
        $data['sort'] = $package->pricingTiers()->count();

        $package->pricingTiers()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-harga')->with('success', 'Pilihan harga ditambahkan.');
    }

    public function updatePricing(Request $request, PricingTier $tier): RedirectResponse
    {
        $tier->update($this->pricingData($request));

        return redirect()->route('admin.packages.edit', $tier->package)->withFragment('tab-harga')->with('success', 'Pilihan harga diperbarui.');
    }

    public function destroyPricing(PricingTier $tier): RedirectResponse
    {
        $package = $tier->package;
        $tier->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-harga')->with('success', 'Pilihan harga dihapus.');
    }

    private function pricingData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:100'],
            'badge_class' => ['nullable', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:100'],
            'price_compare' => ['nullable', 'string', 'max:100'],
            'note' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_class' => ['nullable', 'string', 'max:200'],
        ]);
    }

    // ---- Facility ----

    public function storeFacility(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:included,excluded'],
            'text' => ['required', 'string', 'max:255'],
        ]);
        $data['sort'] = $package->facility()
            ->where('type', $data['type'])
            ->count();

        $package->facility()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-fasilitas')->with('success', 'Fasilitas ditambahkan.');
    }

    public function updateFacility(Request $request, FacilityItem $item): RedirectResponse
    {
        $item->update($request->validate([
            'type' => ['required', 'in:included,excluded'],
            'text' => ['required', 'string', 'max:255'],
        ]));

        return redirect()->route('admin.packages.edit', $item->package)->withFragment('tab-fasilitas')->with('success', 'Fasilitas diperbarui.');
    }

    public function destroyFacility(FacilityItem $item): RedirectResponse
    {
        $package = $item->package;
        $item->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-fasilitas')->with('success', 'Fasilitas dihapus.');
    }

    // ---- FAQ ----

    public function storeFaq(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ]);
        $data['sort'] = $package->faqs()->count();

        $package->faqs()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-faq')->with('success', 'FAQ ditambahkan.');
    }

    public function updateFaq(Request $request, Faq $faq): RedirectResponse
    {
        $faq->update($request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ]));

        return redirect()->route('admin.packages.edit', $faq->package)->withFragment('tab-faq')->with('success', 'FAQ diperbarui.');
    }

    public function destroyFaq(Faq $faq): RedirectResponse
    {
        $package = $faq->package;
        $faq->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-faq')->with('success', 'FAQ dihapus.');
    }

    // ---- Gallery ----

    public function storeGallery(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
            'gradient' => ['required', 'string', 'max:200'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]);
        $data['kind'] = 'gallery';
        $data['sort'] = $package->images()->count();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages/' . $package->slug . '/gallery', 'public');
        }

        $package->images()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-galeri')->with('success', 'Gambar galeri ditambahkan.');
    }

    public function destroyGallery(PackageImage $image): RedirectResponse
    {
        $package = $image->package;
        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-galeri')->with('success', 'Gambar galeri dihapus.');
    }

    // ---- Testimonial ----

    public function storeTestimonial(Request $request, Package $package): RedirectResponse
    {
        $data = $this->testimonialData($request);
        $data['sort'] = $package->testimonials()->count();

        $package->testimonials()->create($data);

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-testimoni')->with('success', 'Testimoni ditambahkan.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update($this->testimonialData($request));

        return redirect()->route('admin.packages.edit', $testimonial->package)->withFragment('tab-testimoni')->with('success', 'Testimoni diperbarui.');
    }

    public function destroyTestimonial(Testimonial $testimonial): RedirectResponse
    {
        $package = $testimonial->package;
        $testimonial->delete();

        return redirect()->route('admin.packages.edit', $package)->withFragment('tab-testimoni')->with('success', 'Testimoni dihapus.');
    }

    private function testimonialData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'avatar_gradient' => ['nullable', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'text' => ['required', 'string', 'max:2000'],
        ]);
    }
}
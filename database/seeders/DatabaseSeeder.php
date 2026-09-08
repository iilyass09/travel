<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Faq;
use App\Models\FacilityItem;
use App\Models\ItineraryItem;
use App\Models\KulinerSpot;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PricingTier;
use App\Models\Setting;
use App\Models\ShoppingSpot;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\VehicleFeature;
use App\Models\VehicleStat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private array $included = [
        'Mobil Calya / Sigra + Driver profesional',
        'Bahan bakar (BBM) full untuk rute paket',
        '1x makan siang di restoran lokal',
        'Air mineral selama perjalanan',
        'Driver berpengalaman merangkap pemandu wisata',
        'Biaya parkir pada titik-titik destinasi',
    ];

    private array $excluded = [
        'Tiket masuk objek wisata',
        'Penginapan / hotel',
        'Pengeluaran pribadi (oleh-oleh, dll)',
        'Kelebihan jam di luar durasi paket',
    ];

    private array $faqs = [
        ['Jam berapa penjemputan dilakukan?', 'Penjemputan fleksibel, umumnya pukul 06.30 - 07.00 WIB. Anda bisa menyesuaikan waktu dengan kebutuhan dan bisa disepakati saat pemesanan.'],
        ['Apakah harga sudah termasuk tiket masuk objek wisata?', 'Belum. Harga paket sudah termasuk mobil, driver, BBM, parkir, dan makan siang. Tiket masuk objek wisata dapat dibayar langsung atau menggunakan Paket Plus Tiket.'],
        ['Bisa custom rute atau destinasi?', 'Tentu bisa. Tim kami akan dengan senang hati menyusun rute yang paling sesuai dengan keinginan Anda, baik untuk keluarga maupun rombongan.'],
        ['Bagaimana sistem pembayarannya?', 'Pemesanan dikonfirmasi dengan DP 50%, sisanya dilunasi pada hari wisata. Pembayaran dapat melalui transfer bank atau e-wallet.'],
        ['Berapa kapasitas maksimal kendaraan?', 'Calya/Sigra nyaman untuk maksimal 6 orang dewasa + 1 anak, ideal untuk 2-6 orang agar perjalanan lebih lega.'],
    ];

    public function run(): void
    {
        $this->seedAdmin();
        $this->seedSettings();
        $this->seedDestinations();
        $this->seedKuliner();
        $this->seedShopping();
        $this->seedVehicle();
        $this->seedPackageLembang();
        $this->seedPackageCiwidey();
        $this->seedPackagePangalengan();
    }

    private function seedAdmin(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Gaskeun Travel',
                'email' => 'admin@gaskeuntravel.com',
                'password' => Hash::make('admin'),
            ]
        );
    }

    private function seedSettings(): void
    {
        $settings = [
            // Perusahaan
            'company_name' => ['Gaskeun Travel', 'perusahaan'],
            'company_tagline' => ['Gaskeun Travel menyediakan layanan wisata terbaik di Bandung dengan pengalaman yang tak terlupakan.', 'perusahaan'],
            'wa_number' => ['6281234567890', 'perusahaan'],
            'phone_display' => ['+62 812-3456-7890', 'perusahaan'],
            'email' => ['info@gaskeuntravel.com', 'perusahaan'],
            'address' => ['Jl. Asia Afrika No. 123, Bandung', 'perusahaan'],
            'instagram_url' => ['#', 'perusahaan'],
            'tiktok_url' => ['#', 'perusahaan'],
            'copyright_text' => ['© 2026 Gaskeun Travel. All rights reserved.', 'perusahaan'],
            // Hero
            'hero_badge' => ['Best Seller City Tour Bandung', 'hero'],
            'hero_title_part1' => ['Jelajahi', 'hero'],
            'hero_title_accent' => ['Bandung', 'hero'],
            'hero_title_part2' => ['dengan Nyaman & Menyenangkan', 'hero'],
            'hero_subtitle' => ['Gaskeun Travel hadir untuk memberikan pengalaman wisata terbaik di Bandung. Nikmati perjalanan seru dengan driver berpengalaman dan kendaraan nyaman.', 'hero'],
            'hero_stat1_count' => ['500', 'hero'],
            'hero_stat1_label' => ['Wisatawan Puas', 'hero'],
            'hero_stat2_count' => ['50', 'hero'],
            'hero_stat2_label' => ['Destinasi Wisata', 'hero'],
            'hero_stat3_count' => ['5', 'hero'],
            'hero_stat3_suffix' => ['+', 'hero'],
            'hero_stat3_label' => ['Tahun Pengalaman', 'hero'],
            'hero_card_eyebrow' => ['GASKEUN TRAVEL', 'hero'],
            'hero_card_subtitle' => ['Your Bandung Adventure Starts Here', 'hero'],
            'hero_vehicles' => ['Lembang|Ciwidey|Pangalengan', 'hero'],
            // Hero card stats (mini tiles di bawah card) [opsional]
            'hero_card_caption' => ['Your Bandung Adventure Starts Here', 'hero'],
            // Paket section
            'paket_badge' => ['Best Seller', 'paket'],
            'paket_title_prefix' => ['Paket', 'paket'],
            'paket_title_accent' => ['City Tour Bandung', 'paket'],
            'paket_subtitle' => ['Pilihan paket wisata terbaik untuk menjelajahi keindahan Bandung', 'paket'],
            // Destinasi section
            'destinasi_badge' => ['Tempat Wisata', 'destinasi'],
            'destinasi_title_prefix' => ['Destinasi', 'destinasi'],
            'destinasi_title_accent' => ['Wisata', 'destinasi'],
            'destinasi_title_suffix' => ['Bandung', 'destinasi'],
            'destinasi_subtitle' => ['Jelajahi berbagai tempat wisata menarik di seluruh penjuru Bandung', 'destinasi'],
            // Kuliner section
            'kuliner_badge' => ['Kuliner Nikmat', 'kuliner'],
            'kuliner_title_prefix' => ['Spot', 'kuliner'],
            'kuliner_title_accent' => ['Kuliner', 'kuliner'],
            'kuliner_title_suffix' => ['Bandung', 'kuliner'],
            'kuliner_subtitle' => ['Cicipi berbagai kuliner lezat khas Bandung yang menggugah selera', 'kuliner'],
            // Shopping section
            'shopping_badge' => ['Shopping Seru', 'shopping'],
            'shopping_title_prefix' => ['Tempat', 'shopping'],
            'shopping_title_accent' => ['Shopping', 'shopping'],
            'shopping_title_suffix' => ['Bandung', 'shopping'],
            'shopping_subtitle' => ['Belanja sepuasnya di berbagai tempat shopping favorit di Bandung', 'shopping'],
            'shopping_note' => ['Dan masih banyak tempat shopping lainnya yang bisa dikunjungi', 'shopping'],
            // Kendaraan section
            'kendaraan_badge' => ['Kendaraan Kami', 'kendaraan'],
            'kendaraan_title_part1' => ['Calya / Sigra', 'kendaraan'],
            'kendaraan_title_accent' => ['Terbaik', 'kendaraan'],
            'kendaraan_subtitle' => ['Kendaraan nyaman dan terawat untuk perjalanan wisata Anda. Dilengkapi dengan driver berpengalaman yang siap menemani petualangan Anda di Bandung.', 'kendaraan'],
            'kendaraan_panel_title' => ['CALYA / SIGRA', 'kendaraan'],
            'kendaraan_panel_subtitle' => ['Comfortable & Safe', 'kendaraan'],
            // CTA / Kontak
            'cta_badge' => ['Hubungi Kami Sekarang', 'cta'],
            'cta_title' => ['Siap Jelajahi Bandung?', 'cta'],
            'cta_subtitle' => ['Jangan tunda lagi! Pesan paket wisata sekarang dan nikmati petualangan seru di Bandung bersama Gaskeun Travel.', 'cta'],
        ];

        foreach ($settings as $key => [$value, $group]) {
            Setting::set($key, $value, $group);
        }
    }

    private function seedDestinations(): void
    {
        $items = [
            ['Lembang', 'alami', 'from-green-500 to-emerald-700'],
            ['Ciwidey', 'alami', 'from-cyan-500 to-blue-700'],
            ['Pangalengan', 'alami', 'from-teal-500 to-green-700'],
            ['Bandung Kota', 'kota', 'from-orange-500 to-red-600'],
            ['Dago', 'wisata', 'from-purple-500 to-indigo-700'],
            ['Maribaya', 'alami', 'from-lime-500 to-green-700'],
            ['Cikole', 'alami', 'from-emerald-500 to-green-800'],
            ['Dan Lainnya', 'wisata', 'from-gray-700 to-gray-900'],
        ];

        foreach ($items as $i => [$name, $category, $gradient]) {
            Destination::create(['name' => $name, 'category' => $category, 'gradient' => $gradient, 'sort' => $i]);
        }
    }

    private function seedKuliner(): void
    {
        $items = [
            ['Braga Culinary Night', 'Nikmati suasana malam Braga dengan berbagai pilihan kuliner dari seluruh nusantara.', 'Malam Hari, Street Food', 'from-orange-400 to-orange-600'],
            ['Sudirman Street Food', 'Jajanan kaki lima yang legendaris di Jalan Sudirman dengan berbagai pilihan makanan.', 'Legendaris, Murah Meriah', 'from-blue-400 to-blue-600'],
            ['Kampung Daun', 'Restoran dengan konsep pedesaan yang menyajikan masakan Sunda autentik di tengah alam.', 'Alam, Sunda', 'from-green-400 to-emerald-600'],
            ['The Valley Bistro', 'Fine dining dengan pemandangan lembah yang memukau dan menu internasional berkualitas.', 'Fine Dining, Premium', 'from-purple-400 to-purple-600'],
            ['Nasi Kakang', 'Nasi timbel khas Sunda dengan lauk lengkap yang menggugah selera dan harga terjangkau.', 'Khas Sunda, Terjangkau', 'from-yellow-400 to-orange-500'],
            ['Cuankie dan Batagor', 'Jajanan khas Bandung yang wajib dicoba dengan kuah kacang yang kaya rasa.', 'Khas Bandung, Wajib Coba', 'from-red-400 to-pink-500'],
        ];

        foreach ($items as $i => [$name, $desc, $tags, $gradient]) {
            KulinerSpot::create(['name' => $name, 'description' => $desc, 'tags' => $tags, 'gradient' => $gradient, 'sort' => $i]);
        }
    }

    private function seedShopping(): void
    {
        $items = [
            ['Factory Outlet', 'Koleksi fashion branded dengan harga outlet terjangkau', 'from-blue-600 to-blue-800', 'text-orange-300'],
            ['Paris Van Java', 'Mall premium dengan berbagai tenant internasional', 'from-purple-600 to-indigo-800', 'text-orange-300'],
            ['Cihampelas Walk', 'Shopping street dengan suasana unik dan nyaman', 'from-orange-500 to-red-600', 'text-yellow-300'],
            ['23 Paskal', 'Lifestyle center dengan konsep open-air yang asri', 'from-teal-500 to-emerald-600', 'text-yellow-300'],
            ['Pasar Baru', 'Pasar tradisional terlengkap dengan berbagai kebutuhan', 'from-pink-500 to-rose-600', 'text-yellow-300'],
            ['Istana Plaza', 'Mall modern dengan lifestyle dan entertainment lengkap', 'from-amber-500 to-orange-600', 'text-white/80'],
        ];

        foreach ($items as $i => [$name, $desc, $gradient, $icon]) {
            ShoppingSpot::create(['name' => $name, 'description' => $desc, 'gradient' => $gradient, 'icon_light' => $icon, 'sort' => $i]);
        }
    }

    private function seedVehicle(): void
    {
        $features = [
            ['Driver Berpengalaman & Ramah', 'Driver profesional yang hafal setiap sudut kota Bandung', 'from-orange-400 to-orange-600'],
            ['Mobil Nyaman, Bersih & Terawat', 'Armada terawat dengan perawatan berkala untuk kenyamanan Anda', 'from-blue-400 to-blue-600'],
            ['Sudah Termasuk BBM', 'Tidak perlu khawatir biaya bahan bakar, sudah termasuk dalam paket', 'from-green-400 to-emerald-600'],
            ['Siap Antar Destinasi Favorit Anda', 'Fleksibel ke mana saja sesuai keinginan Anda', 'from-orange-400 to-red-500'],
        ];

        foreach ($features as $i => [$title, $text, $gradient]) {
            VehicleFeature::create(['title' => $title, 'text' => $text, 'gradient' => $gradient, 'sort' => $i]);
        }

        $stats = [
            ['AC', 'Dingin & Sejuk'],
            ['7', 'Seat Capacity'],
            ['GPS', 'Navigation'],
        ];

        foreach ($stats as $i => [$title, $caption]) {
            VehicleStat::create(['title' => $title, 'caption' => $caption, 'sort' => $i]);
        }
    }

    private function makePackage(array $data, array $itinerary, array $tiers, array $gallery, array $testimonials): Package
    {
        $package = Package::create($data);

        foreach ($itinerary as $i => $item) {
            ItineraryItem::create($item + ['package_id' => $package->id, 'sort' => $i]);
        }

        foreach ($this->included as $i => $text) {
            FacilityItem::create(['package_id' => $package->id, 'type' => 'included', 'text' => $text, 'sort' => $i]);
        }

        foreach ($this->excluded as $i => $text) {
            FacilityItem::create(['package_id' => $package->id, 'type' => 'excluded', 'text' => $text, 'sort' => $i]);
        }

        foreach ($this->faqs as $i => [$question, $answer]) {
            Faq::create(['package_id' => $package->id, 'question' => $question, 'answer' => $answer, 'sort' => $i]);
        }

        foreach ($tiers as $i => $tier) {
            PricingTier::create($tier + ['package_id' => $package->id, 'sort' => $i]);
        }

        foreach ($gallery as $i => $photo) {
            PackageImage::create($photo + ['package_id' => $package->id, 'kind' => 'gallery', 'sort' => $i]);
        }

        foreach ($testimonials as $i => $t) {
            Testimonial::create($t + ['package_id' => $package->id, 'sort' => $i]);
        }

        return $package;
    }

    private function seedPackageLembang(): void
    {
        $this->makePackage(
            [
                'name' => 'Lembang',
                'slug' => 'lembang',
                'category' => 'CITY TOUR',
                'badge' => 'BEST SELLER',
                'badge_dot_class' => 'bg-green-400',
                'badge_text_class' => 'text-green-700',
                'card_gradient' => 'from-green-400 to-emerald-600',
                'detail_gradient' => 'from-blue-900 via-blue-800 to-emerald-900',
                'tagline' => 'Nikmati udara sejuk, pemandangan pegunungan, dan destinasi wisata paling ikonik di Lembang dengan kendaraan nyaman dan driver berpengalaman.',
                'short_desc' => 'Nikmati keindahan alam Lembang dengan udara sejuk dan pemandangan spektakuler yang memukau.',
                'description' => 'Paket City Tour menuju kawasan wisata Lembang yang ikonik. Udara sejuk, pemandangan pegunungan, dan beragam destinasi menarik menanti Anda. Fasilitas lengkap mulai dari mobil Calya/Sigra, driver profesional, BBM, hingga makan siang khas Sunda.',
                'meta_description' => 'Paket City Tour Lembang dengan mobil + driver profesional. Mulai dari Rp 600.000. Termasuk BBM dan makan siang.',
                'duration' => '±10 Jam',
                'seat_count' => '7 Seat',
                'seat_note' => 'Calya / Sigra',
                'price' => 'Rp 600.000',
                'price_compare' => 'Rp 850.000',
                'is_best_seller' => true,
                'sort' => 0,
            ],
            [
                ['time' => '06.30', 'label' => 'Start', 'title' => 'Penjemputan di Lokasi Anda', 'description' => 'Driver Gaskeun Travel menjemput di hotel atau titik penjemputan area Bandung dengan mobil Calya/Sigra yang bersih dan ber-AC.'],
                ['time' => '07.30', 'label' => 'Destinasi 1', 'title' => 'Tangkuban Perahu', 'description' => 'Nikmati keindahan kawah vulkanik dan udara sejuk khas pegunungan, sambil berfoto dengan pemandangan yang ikonik.'],
                ['time' => '10.00', 'label' => 'Destinasi 2', 'title' => 'Farmhouse Susu Lembang', 'description' => 'Berfoto ala bangunan Eropa, memberi makan kelinci, dan menikmati susu murni segar yang lezat.'],
                ['time' => '12.00', 'label' => 'Istirahat', 'title' => 'Makan Siang Khas Sunda', 'description' => 'Istirahat sejenak sambil menikmati makan siang khas Sunda di restoran lokal sekitar Lembang (sudah termasuk).'],
                ['time' => '14.00', 'label' => 'Destinasi 3', 'title' => 'The Lodge Maribaya', 'description' => 'Coba swing dengan latar pepohonan pinus serta nikmati suasana alam Lembang yang asri sebelum pulang.'],
                ['time' => '18.00', 'label' => 'Pulang', 'title' => 'Kembali ke Lokasi Awal', 'description' => 'Perjalanan pulang dengan aman dan nyaman. Tiba di titik penjemputan diperkirakan pukul 18.00-19.00.'],
            ],
            [
                ['name' => 'Paket Hemat', 'badge' => 'PALING LARIS', 'badge_class' => 'bg-blue-600', 'subtitle' => 'Cocok untuk 2-3 orang', 'price' => 'Rp 600.000', 'price_compare' => 'Rp 850.000', 'features' => "Mobil + Driver + BBM\nDurasi ±10 jam\n1x makan siang", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-blue-600 to-blue-700'],
                ['name' => 'Paket Keluarga', 'badge' => 'PAKET KELUARGA', 'badge_class' => 'bg-orange-500', 'subtitle' => 'Cocok untuk 4-6 orang', 'price' => 'Rp 850.000', 'price_compare' => 'Rp 1.100.000', 'features' => "Mobil + Driver + BBM\nDurasi ±11 jam\n1x makan siang + snack\nPrioritas kendaraan baru", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-orange-500 to-orange-600'],
                ['name' => 'Paket Plus Tiket', 'badge' => 'PAKET PLUS', 'badge_class' => 'bg-gray-700', 'subtitle' => 'Semua destinasi diakomodasi', 'price' => 'Custom', 'price_compare' => null, 'note' => 'Sesuai jumlah objek wisata', 'features' => "Tiket masuk semua objek wisata\nRute bebas / custom\nKonsultasi tim kami", 'button_text' => 'Konsultasi', 'button_class' => 'bg-gradient-to-r from-gray-700 to-gray-800'],
            ],
            [
                ['gradient' => 'from-green-500 to-emerald-700', 'caption' => 'Tangkuban Perahu'],
                ['gradient' => 'from-cyan-500 to-blue-700', 'caption' => 'Farmhouse Susu'],
                ['gradient' => 'from-emerald-500 to-teal-700', 'caption' => 'The Lodge Maribaya'],
                ['gradient' => 'from-purple-500 to-indigo-700', 'caption' => 'Floating Market'],
            ],
            [
                ['name' => 'Andi Wijaya', 'role' => 'Wisata Keluarga', 'avatar_gradient' => 'from-blue-500 to-blue-700', 'rating' => 5, 'text' => 'Driver-nya ramah dan hafal rute. Waktu kami fleksibel dan tidak terburu-buru, anak-anak senang banget di Farmhouse!'],
                ['name' => 'Sari Putri', 'role' => 'Pasar Wisata', 'avatar_gradient' => 'from-pink-500 to-rose-600', 'rating' => 5, 'text' => 'Mobil bersih, AC dingin, dan harga sesuai kantong. Pesan via WhatsApp pun sangat cepat responnya.'],
                ['name' => 'Budi Santoso', 'role' => 'Rombongan Karyawan', 'avatar_gradient' => 'from-emerald-500 to-green-700', 'rating' => 4, 'text' => 'Awalnya ragu, tapi ternyata worth it. Itinerary jelas dan tidak ada biaya tersembunyi. Pasti balik lagi!'],
            ]
        );
    }

    private function seedPackageCiwidey(): void
    {
        $this->makePackage(
            [
                'name' => 'Ciwidey',
                'slug' => 'ciwidey',
                'category' => 'CITY TOUR',
                'badge' => 'POPULER',
                'badge_dot_class' => 'bg-cyan-400',
                'badge_text_class' => 'text-cyan-700',
                'card_gradient' => 'from-blue-400 to-cyan-600',
                'detail_gradient' => 'from-blue-900 via-blue-800 to-cyan-900',
                'tagline' => 'Eksplor Kawah Putih yang eksotis, danau Situ Patenggang yang romantis, serta kebun teh Rancabali yang hijau menyegarkan.',
                'short_desc' => 'Eksplor keindahan Ciwidey dengan danau vulkanik, perkebunan teh, dan pemandangan alam yang memesona.',
                'description' => 'Paket City Tour menuju kawasan Ciwidey yang terkenal dengan Kawah Putih dan Situ Patenggang. Nikmati pemandangan danau vulkanik yang memesona serta udara segar khas dataran tinggi.',
                'meta_description' => 'Paket City Tour Ciwidey dengan mobil + driver profesional. Mulai dari Rp 700.000. Termasuk BBM dan makan siang.',
                'duration' => '±10 Jam',
                'seat_count' => '7 Seat',
                'seat_note' => 'Calya / Sigra',
                'price' => 'Rp 700.000',
                'price_compare' => 'Rp 950.000',
                'is_best_seller' => false,
                'sort' => 1,
            ],
            [
                ['time' => '06.30', 'label' => 'Start', 'title' => 'Penjemputan di Lokasi Anda', 'description' => 'Driver Gaskeun Travel menjemput di hotel atau titik penjemputan area Bandung dengan mobil Calya/Sigra yang bersih dan ber-AC.'],
                ['time' => '08.00', 'label' => 'Destinasi 1', 'title' => 'Kawah Putih', 'description' => 'Nikmati pesona danau kawah vulkanik dengan air putih kehijauan dan kabut yang menambah kesan mistis.'],
                ['time' => '11.00', 'label' => 'Destinasi 2', 'title' => 'Situ Patenggang', 'description' => 'Wisata danau romantis dengan perahu dan pemandangan kebun teh yang menyejukkan mata.'],
                ['time' => '12.30', 'label' => 'Istirahat', 'title' => 'Makan Siang Khas Sunda', 'description' => 'Istirahat sejenak sambil menikmati makan siang khas Sunda di restoran lokal sekitar Ciwidey (sudah termasuk).'],
                ['time' => '14.00', 'label' => 'Destinasi 3', 'title' => 'Kebun Teh Rancabali', 'description' => 'Jalan-jalan di hamparan kebun teh yang luas sambil menikmati udara segar pegunungan.'],
                ['time' => '18.00', 'label' => 'Pulang', 'title' => 'Kembali ke Lokasi Awal', 'description' => 'Perjalanan pulang dengan aman dan nyaman. Tiba di titik penjemputan diperkirakan pukul 18.00-19.00.'],
            ],
            [
                ['name' => 'Paket Hemat', 'badge' => 'PALING LARIS', 'badge_class' => 'bg-blue-600', 'subtitle' => 'Cocok untuk 2-3 orang', 'price' => 'Rp 700.000', 'price_compare' => 'Rp 950.000', 'features' => "Mobil + Driver + BBM\nDurasi ±10 jam\n1x makan siang", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-blue-600 to-blue-700'],
                ['name' => 'Paket Keluarga', 'badge' => 'PAKET KELUARGA', 'badge_class' => 'bg-orange-500', 'subtitle' => 'Cocok untuk 4-6 orang', 'price' => 'Rp 950.000', 'price_compare' => 'Rp 1.250.000', 'features' => "Mobil + Driver + BBM\nDurasi ±11 jam\n1x makan siang + snack\nPrioritas kendaraan baru", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-orange-500 to-orange-600'],
                ['name' => 'Paket Plus Tiket', 'badge' => 'PAKET PLUS', 'badge_class' => 'bg-gray-700', 'subtitle' => 'Semua destinasi diakomodasi', 'price' => 'Custom', 'price_compare' => null, 'note' => 'Sesuai jumlah objek wisata', 'features' => "Tiket masuk semua objek wisata\nRute bebas / custom\nKonsultasi tim kami", 'button_text' => 'Konsultasi', 'button_class' => 'bg-gradient-to-r from-gray-700 to-gray-800'],
            ],
            [
                ['gradient' => 'from-cyan-500 to-blue-700', 'caption' => 'Kawah Putih'],
                ['gradient' => 'from-sky-500 to-indigo-700', 'caption' => 'Situ Patenggang'],
                ['gradient' => 'from-emerald-500 to-green-700', 'caption' => 'Kebun Teh Rancabali'],
                ['gradient' => 'from-orange-500 to-red-600', 'caption' => 'Glamping Lakeside'],
            ],
            [
                ['name' => 'Rina Kartika', 'role' => 'Pasangan Wisata', 'avatar_gradient' => 'from-cyan-500 to-blue-700', 'rating' => 5, 'text' => 'Kawah Putih-nya bikin terpukau! Driver sabar menunggu kami foto-foto tanpa diburu-buru. Recommended!'],
                ['name' => 'Dimas Pratama', 'role' => 'Freelancer', 'avatar_gradient' => 'from-purple-500 to-indigo-700', 'rating' => 5, 'text' => 'Booking gampang, langsung via WhatsApp. Harga jelas dan cocok buat rombongan kecil.'],
                ['name' => 'Mega Lestari', 'role' => 'Liburan Keluarga', 'avatar_gradient' => 'from-orange-400 to-red-500', 'rating' => 4, 'text' => 'Mau ke Situ Patenggang nggak antre benar karena datang lebih pagi. Terima kasih Gaskeun Travel!'],
            ]
        );
    }

    private function seedPackagePangalengan(): void
    {
        $this->makePackage(
            [
                'name' => 'Pangalengan',
                'slug' => 'pangalengan',
                'category' => 'CITY TOUR',
                'badge' => 'FAVORIT',
                'badge_dot_class' => 'bg-teal-400',
                'badge_text_class' => 'text-teal-700',
                'card_gradient' => 'from-emerald-400 to-teal-600',
                'detail_gradient' => 'from-blue-900 via-blue-800 to-teal-900',
                'tagline' => 'Petualangan seru di Pangalengan dengan kebun teh hijau, danau Situ Cileunca, dan destinasi alam yang menakjubkan.',
                'short_desc' => 'Petualangan seru di Pangalengan dengan kebun teh hijau, sungai, dan destinasi alam yang menakjubkan.',
                'description' => 'Paket City Tour menuju Pangalengan yang asri dengan kebun teh Malabar dan Situ Cileunca. Suasana tenang dan udara segar sangat cocok untuk liburan keluarga.',
                'meta_description' => 'Paket City Tour Pangalengan dengan mobil + driver profesional. Mulai dari Rp 700.000. Termasuk BBM dan makan siang.',
                'duration' => '±10 Jam',
                'seat_count' => '7 Seat',
                'seat_note' => 'Calya / Sigra',
                'price' => 'Rp 700.000',
                'price_compare' => 'Rp 950.000',
                'is_best_seller' => false,
                'sort' => 2,
            ],
            [
                ['time' => '06.30', 'label' => 'Start', 'title' => 'Penjemputan di Lokasi Anda', 'description' => 'Driver Gaskeun Travel menjemput di hotel atau titik penjemputan area Bandung dengan mobil Calya/Sigra yang bersih dan ber-AC.'],
                ['time' => '08.00', 'label' => 'Destinasi 1', 'title' => 'Situ Cileunca', 'description' => 'Naik perahu wisata di danau dengan latar hamparan kebun teh yang membentang luas.'],
                ['time' => '11.00', 'label' => 'Destinasi 2', 'title' => 'Kebun Teh Malabar', 'description' => 'Berjalan santai di antara barisan tanaman teh hijau dan menikmati udara sejuk perkebunan.'],
                ['time' => '12.30', 'label' => 'Istirahat', 'title' => 'Makan Siang Khas Sunda', 'description' => 'Istirahat sejenak sambil menikmati makan siang khas Sunda di restoran lokal sekitar Pangalengan (sudah termasuk).'],
                ['time' => '14.00', 'label' => 'Destinasi 3', 'title' => 'Puncak Pinus', 'description' => 'Bersantai di hutan pinus dengan spot foto estetik dan udara yang sangat segar.'],
                ['time' => '18.00', 'label' => 'Pulang', 'title' => 'Kembali ke Lokasi Awal', 'description' => 'Perjalanan pulang dengan aman dan nyaman. Tiba di titik penjemputan diperkirakan pukul 18.00-19.00.'],
            ],
            [
                ['name' => 'Paket Hemat', 'badge' => 'PALING LARIS', 'badge_class' => 'bg-blue-600', 'subtitle' => 'Cocok untuk 2-3 orang', 'price' => 'Rp 700.000', 'price_compare' => 'Rp 950.000', 'features' => "Mobil + Driver + BBM\nDurasi ±10 jam\n1x makan siang", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-blue-600 to-blue-700'],
                ['name' => 'Paket Keluarga', 'badge' => 'PAKET KELUARGA', 'badge_class' => 'bg-orange-500', 'subtitle' => 'Cocok untuk 4-6 orang', 'price' => 'Rp 950.000', 'price_compare' => 'Rp 1.250.000', 'features' => "Mobil + Driver + BBM\nDurasi ±11 jam\n1x makan siang + snack\nPrioritas kendaraan baru", 'button_text' => 'Pilih Paket', 'button_class' => 'bg-gradient-to-r from-orange-500 to-orange-600'],
                ['name' => 'Paket Plus Tiket', 'badge' => 'PAKET PLUS', 'badge_class' => 'bg-gray-700', 'subtitle' => 'Semua destinasi diakomodasi', 'price' => 'Custom', 'price_compare' => null, 'note' => 'Sesuai jumlah objek wisata', 'features' => "Tiket masuk semua objek wisata\nRute bebas / custom\nKonsultasi tim kami", 'button_text' => 'Konsultasi', 'button_class' => 'bg-gradient-to-r from-gray-700 to-gray-800'],
            ],
            [
                ['gradient' => 'from-emerald-500 to-teal-700', 'caption' => 'Situ Cileunca'],
                ['gradient' => 'from-green-500 to-emerald-700', 'caption' => 'Kebun Teh Malabar'],
                ['gradient' => 'from-teal-500 to-cyan-700', 'caption' => 'Puncak Pinus'],
                ['gradient' => 'from-blue-500 to-indigo-700', 'caption' => 'Damau Pasir Putih'],
            ],
            [
                ['name' => 'Hendra Gunawan', 'role' => 'Pecinta Alam', 'avatar_gradient' => 'from-teal-500 to-cyan-700', 'rating' => 5, 'text' => 'Situ Cileunca nan indah dan jernih, Puncak Pinus bikin betah. Driver sangat kooperatif.'],
                ['name' => 'Intan Permata', 'role' => 'Foto Prewed', 'avatar_gradient' => 'from-pink-500 to-rose-600', 'rating' => 5, 'text' => 'Bawa ke kebun teh Malabar pas golden hour, hasil fotonya bagus banget. Terima kasih banyak!'],
                ['name' => 'Agus Salim', 'role' => 'Trip Keluarga', 'avatar_gradient' => 'from-green-500 to-emerald-700', 'rating' => 4, 'text' => 'Anak-anak senang naik perahu di danau. Mobil bersih dan hari kami jadi lebih santai.'],
            ]
        );
    }
}
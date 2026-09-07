<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    private array $groups = [
        'perusahaan' => 'Identitas Perusahaan',
        'hero' => 'Hero / Beranda',
        'paket' => 'Section Paket Wisata',
        'destinasi' => 'Section Destinasi',
        'kuliner' => 'Section Kuliner',
        'shopping' => 'Section Shopping',
        'kendaraan' => 'Section Kendaraan',
        'cta' => 'Section Kontak / CTA',
    ];

    private array $fields = [
        // [group, key, label, type]
        ['perusahaan', 'company_name', 'Nama Perusahaan', 'text'],
        ['perusahaan', 'company_tagline', 'Tagline (deskripsi footer)', 'textarea'],
        ['perusahaan', 'wa_number', 'Nomor WhatsApp (format 62xxx, tanpa + / spasi)', 'text'],
        ['perusahaan', 'phone_display', 'Nomor Telepon (tampilan)', 'text'],
        ['perusahaan', 'email', 'Email', 'text'],
        ['perusahaan', 'address', 'Alamat', 'textarea'],
        ['perusahaan', 'instagram_url', 'Link Instagram', 'text'],
        ['perusahaan', 'tiktok_url', 'Link TikTok', 'text'],
        ['perusahaan', 'copyright_text', 'Teks Copyright', 'text'],
        ['hero', 'hero_badge', 'Badge Hero', 'text'],
        ['hero', 'hero_title_part1', 'Judul Hero (bagian 1)', 'text'],
        ['hero', 'hero_title_accent', 'Judul Hero (kata aksen)', 'text'],
        ['hero', 'hero_title_part2', 'Judul Hero (bagian 2)', 'text'],
        ['hero', 'hero_subtitle', 'Subjudul Hero', 'textarea'],
        ['hero', 'hero_stat1_count', 'Statistik 1 - Angka', 'text'],
        ['hero', 'hero_stat1_label', 'Statistik 1 - Label', 'text'],
        ['hero', 'hero_stat2_count', 'Statistik 2 - Angka', 'text'],
        ['hero', 'hero_stat2_label', 'Statistik 2 - Label', 'text'],
        ['hero', 'hero_stat3_count', 'Statistik 3 - Angka', 'text'],
        ['hero', 'hero_stat3_suffix', 'Statistik 3 - Suffix (mis. +)', 'text'],
        ['hero', 'hero_stat3_label', 'Statistik 3 - Label', 'text'],
        ['hero', 'hero_card_eyebrow', 'Kartu Hero - Judul', 'text'],
        ['hero', 'hero_card_image', 'Kartu Hero - Foto 1', 'file'],
        ['hero', 'hero_card_image2', 'Kartu Hero - Foto 2', 'file'],
        ['hero', 'hero_card_image3', 'Kartu Hero - Foto 3', 'file'],
        ['hero', 'hero_card_subtitle', 'Kartu Hero - Subjudul', 'text'],
        ['hero', 'hero_vehicles', 'Kartu Hero - Nama Destinasi (pisah dengan |)', 'textarea'],
        ['paket', 'paket_badge', 'Badge', 'text'],
        ['paket', 'paket_title_prefix', 'Judul (bagian 1)', 'text'],
        ['paket', 'paket_title_accent', 'Judul (kata aksen)', 'text'],
        ['paket', 'paket_subtitle', 'Subjudul', 'textarea'],
        ['destinasi', 'destinasi_badge', 'Badge', 'text'],
        ['destinasi', 'destinasi_title_prefix', 'Judul (bagian 1)', 'text'],
        ['destinasi', 'destinasi_title_accent', 'Judul (kata aksen)', 'text'],
        ['destinasi', 'destinasi_title_suffix', 'Judul (bagian akhir)', 'text'],
        ['destinasi', 'destinasi_subtitle', 'Subjudul', 'textarea'],
        ['kuliner', 'kuliner_badge', 'Badge', 'text'],
        ['kuliner', 'kuliner_title_prefix', 'Judul (bagian 1)', 'text'],
        ['kuliner', 'kuliner_title_accent', 'Judul (kata aksen)', 'text'],
        ['kuliner', 'kuliner_title_suffix', 'Judul (bagian akhir)', 'text'],
        ['kuliner', 'kuliner_subtitle', 'Subjudul', 'textarea'],
        ['shopping', 'shopping_badge', 'Badge', 'text'],
        ['shopping', 'shopping_title_prefix', 'Judul (bagian 1)', 'text'],
        ['shopping', 'shopping_title_accent', 'Judul (kata aksen)', 'text'],
        ['shopping', 'shopping_title_suffix', 'Judul (bagian akhir)', 'text'],
        ['shopping', 'shopping_subtitle', 'Subjudul', 'textarea'],
        ['shopping', 'shopping_note', 'Catatan bawah section', 'textarea'],
        ['kendaraan', 'kendaraan_badge', 'Badge', 'text'],
        ['kendaraan', 'kendaraan_title_part1', 'Judul (bagian 1)', 'text'],
        ['kendaraan', 'kendaraan_title_accent', 'Judul (kata aksen)', 'text'],
        ['kendaraan', 'kendaraan_subtitle', 'Subjudul', 'textarea'],
        ['kendaraan', 'kendaraan_panel_title', 'Panel Gambar - Judul', 'text'],
        ['kendaraan', 'kendaraan_panel_subtitle', 'Panel Gambar - Subjudul', 'text'],
        ['kendaraan', 'kendaraan_panel_image', 'Panel Gambar - Foto Kendaraan 1', 'file'],
        ['kendaraan', 'kendaraan_panel_image2', 'Panel Gambar - Foto Kendaraan 2', 'file'],
        ['cta', 'cta_badge', 'Badge', 'text'],
        ['cta', 'cta_title', 'Judul', 'text'],
        ['cta', 'cta_subtitle', 'Subjudul', 'textarea'],
    ];

    public function edit(): View
    {
        $values = [];
        foreach ($this->fields as [$group, $key]) {
            $values[$key] = Setting::get($key);
        }

        return view('admin.settings', [
            'groups' => $this->groups,
            'fields' => $this->fields,
            'values' => $values,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [];
        foreach ($this->fields as [$group, $key, $label, $type]) {
            $rules[$key] = $type === 'file'
                ? ['nullable', 'image', 'max:4096']
                : ['nullable', 'string'];
        }

        $data = $request->validate($rules);

        foreach ($this->fields as [$group, $key, $label, $type]) {
            if ($type === 'file') {
                if ($request->hasFile($key)) {
                    $old = Setting::get($key);
                    if ($old && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }
                    Setting::set($key, $request->file($key)->store('settings', 'public'), $group);
                }
                continue;
            }

            Setting::set($key, $data[$key] ?? null, $group);
        }

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
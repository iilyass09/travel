<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (! function_exists('setting')) {
    function setting(string $key, $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('storage_url')) {
    function storage_url(?string $path): string
    {
        return $path ? url('storage/' . ltrim($path, '/')) : '';
    }
}

if (! function_exists('wa_link')) {
    function wa_link(string $message = ''): string
    {
        $number = setting('wa_number', '6281234567890');

        return 'https://wa.me/' . $number . ($message !== '' ? '?text=' . urlencode($message) : '');
    }
}

if (! function_exists('wa_message')) {
    function wa_message(array $lines): string
    {
        return implode("\n", array_filter($lines, fn ($l) => trim((string) $l) !== ''));
    }
}
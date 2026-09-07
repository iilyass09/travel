<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    public function show(Package $package)
    {
        abort_unless($package->active, 404);

        return view('pages.package', [
            'package' => $package,
            'others' => Package::where('active', true)->where('id', '!=', $package->id)->orderBy('sort')->get(),
        ]);
    }
}
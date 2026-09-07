<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\KulinerSpot;
use App\Models\Package;
use App\Models\ShoppingSpot;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'packageCount' => Package::count(),
            'destinationCount' => Destination::count(),
            'kulinerCount' => KulinerSpot::count(),
            'shoppingCount' => ShoppingSpot::count(),
            'testimonialCount' => Testimonial::count(),
            'packages' => Package::orderBy('sort')->limit(10)->get(),
        ]);
    }
}
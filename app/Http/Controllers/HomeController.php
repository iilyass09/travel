<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\KulinerSpot;
use App\Models\Package;
use App\Models\ShoppingSpot;
use App\Models\VehicleFeature;
use App\Models\VehicleStat;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'packages' => Package::where('active', true)->orderBy('sort')->get(),
            'destinations' => Destination::where('active', true)->orderBy('sort')->get(),
            'kulinerSpots' => KulinerSpot::where('active', true)->orderBy('sort')->get(),
            'shoppingSpots' => ShoppingSpot::where('active', true)->orderBy('sort')->get(),
            'vehicleFeatures' => VehicleFeature::orderBy('sort')->get(),
            'vehicleStats' => VehicleStat::orderBy('sort')->get(),
        ]);
    }
}
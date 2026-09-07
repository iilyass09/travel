<?php

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\KulinerController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShoppingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/paket/{package:slug}', [PackageController::class, 'show'])->name('package.show');

Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'show'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.attempt');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('/packages', AdminPackageController::class)->except(['show']);
    Route::post('/packages/{package}/itinerary', [AdminPackageController::class, 'storeItinerary'])->name('packages.itinerary.store');
    Route::put('/itinerary/{itinerary}', [AdminPackageController::class, 'updateItinerary'])->name('itinerary.update');
    Route::delete('/itinerary/{itinerary}', [AdminPackageController::class, 'destroyItinerary'])->name('itinerary.destroy');

    Route::post('/packages/{package}/pricing', [AdminPackageController::class, 'storePricing'])->name('packages.pricing.store');
    Route::put('/pricing/{tier}', [AdminPackageController::class, 'updatePricing'])->name('pricing.update');
    Route::delete('/pricing/{tier}', [AdminPackageController::class, 'destroyPricing'])->name('pricing.destroy');

    Route::post('/packages/{package}/facility', [AdminPackageController::class, 'storeFacility'])->name('packages.facility.store');
    Route::put('/facility/{item}', [AdminPackageController::class, 'updateFacility'])->name('facility.update');
    Route::delete('/facility/{item}', [AdminPackageController::class, 'destroyFacility'])->name('facility.destroy');

    Route::post('/packages/{package}/faq', [AdminPackageController::class, 'storeFaq'])->name('packages.faq.store');
    Route::put('/faq/{faq}', [AdminPackageController::class, 'updateFaq'])->name('faq.update');
    Route::delete('/faq/{faq}', [AdminPackageController::class, 'destroyFaq'])->name('faq.destroy');

    Route::post('/packages/{package}/gallery', [AdminPackageController::class, 'storeGallery'])->name('packages.gallery.store');
    Route::delete('/gallery/{image}', [AdminPackageController::class, 'destroyGallery'])->name('gallery.destroy');

    Route::post('/packages/{package}/testimonial', [AdminPackageController::class, 'storeTestimonial'])->name('packages.testimonial.store');
    Route::put('/testimonial/{testimonial}', [AdminPackageController::class, 'updateTestimonial'])->name('testimonial.update');
    Route::delete('/testimonial/{testimonial}', [AdminPackageController::class, 'destroyTestimonial'])->name('testimonial.destroy');

    Route::resource('/destinasi', DestinationController::class)->except(['show']);
    Route::resource('/kuliner', KulinerController::class)->except(['show']);
    Route::resource('/shopping', ShoppingController::class)->except(['show']);
    Route::resource('/testimonials', TestimonialController::class)->except(['show']);
});
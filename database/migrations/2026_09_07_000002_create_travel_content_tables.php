<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('umum');
            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->string('category')->default('CITY TOUR');
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('badge')->nullable();
            $table->string('badge_dot_class')->default('bg-green-400');
            $table->string('badge_text_class')->default('text-green-700');
            $table->string('card_gradient')->default('from-green-400 to-emerald-600');
            $table->string('detail_gradient')->default('from-blue-900 via-blue-800 to-emerald-900');
            $table->string('image')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('duration')->nullable();
            $table->string('seat_count')->nullable();
            $table->string('seat_note')->nullable();
            $table->string('price')->nullable();
            $table->string('price_compare')->nullable();
            $table->boolean('is_best_seller')->default(true);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('package_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('gradient')->default('from-green-500 to-emerald-700');
            $table->string('caption')->nullable();
            $table->string('kind')->default('gallery');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('time');
            $table->string('label')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('pricing_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('badge')->nullable();
            $table->string('badge_class')->default('bg-blue-600');
            $table->string('subtitle')->nullable();
            $table->string('price');
            $table->string('price_compare')->nullable();
            $table->string('note')->nullable();
            $table->text('features')->nullable();
            $table->string('button_text')->default('Pilih Paket');
            $table->string('button_class')->default('bg-gradient-to-r from-blue-600 to-blue-700');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('facility_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('type')->default('included');
            $table->text('text');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('avatar_gradient')->default('from-blue-500 to-blue-700');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('text');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('alami');
            $table->string('gradient')->default('from-green-500 to-emerald-700');
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('kuliner_spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('tags')->nullable();
            $table->string('gradient')->default('from-orange-400 to-orange-600');
            $table->string('icon_color')->default('from-orange-400 to-orange-600');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('shopping_spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('gradient')->default('from-blue-600 to-blue-800');
            $table->string('icon_light')->default('text-orange-300');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('vehicle_features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('gradient')->default('from-orange-400 to-orange-600');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('vehicle_stats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('caption');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_features');
        Schema::dropIfExists('vehicle_stats');
        Schema::dropIfExists('shopping_spots');
        Schema::dropIfExists('kuliner_spots');
        Schema::dropIfExists('destinations');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('facility_items');
        Schema::dropIfExists('pricing_tiers');
        Schema::dropIfExists('itinerary_items');
        Schema::dropIfExists('package_images');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('settings');
    }
};
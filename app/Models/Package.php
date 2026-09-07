<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'tagline', 'category', 'short_desc', 'description',
        'badge', 'badge_dot_class', 'badge_text_class', 'card_gradient',
        'detail_gradient', 'image', 'meta_description', 'duration', 'seat_count',
        'seat_note', 'price', 'price_compare', 'is_best_seller', 'active', 'sort',
    ];

    protected $casts = [
        'is_best_seller' => 'boolean',
        'active' => 'boolean',
    ];

    public function itineraries(): HasMany
    {
        return $this->hasMany(ItineraryItem::class)->orderBy('sort');
    }

    public function pricingTiers(): HasMany
    {
        return $this->hasMany(PricingTier::class)->orderBy('sort');
    }

    public function included(): HasMany
    {
        return $this->hasMany(FacilityItem::class)->where('type', 'included')->orderBy('sort');
    }

    public function excluded(): HasMany
    {
        return $this->hasMany(FacilityItem::class)->where('type', 'excluded')->orderBy('sort');
    }

    public function facility(): HasMany
    {
        return $this->hasMany(FacilityItem::class)->orderBy('sort');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('sort');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PackageImage::class)->orderBy('sort');
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(PackageImage::class)->where('kind', 'gallery')->orderBy('sort');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class)->orderBy('sort');
    }

    public function coverUrl(): string
    {
        return $this->image ? storage_url($this->image) : '';
    }
}
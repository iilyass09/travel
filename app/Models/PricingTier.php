<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id', 'name', 'badge', 'badge_class', 'subtitle', 'price',
        'price_compare', 'note', 'features', 'button_text', 'button_class', 'sort',
    ];

    protected $casts = ['sort' => 'integer'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function featureList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->features))));
    }
}
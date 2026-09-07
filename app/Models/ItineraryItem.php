<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'time', 'label', 'title', 'description', 'sort'];

    protected $casts = ['sort' => 'integer'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageImage extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'image', 'gradient', 'caption', 'kind', 'sort'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function url(): string
    {
        return $this->image ? storage_url($this->image) : '';
    }
}
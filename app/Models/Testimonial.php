<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'name', 'role', 'avatar_gradient', 'rating', 'text', 'sort'];

    protected $casts = ['sort' => 'integer'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function initials(): string
    {
        $words = preg_split('/\s+/u', trim((string) $this->name));
        $out = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $out .= mb_substr($w, 0, 1);
        }

        return strtoupper($out);
    }

    public function stars(): string
    {
        return str_repeat('★', (int) $this->rating) . str_repeat('☆', max(0, 5 - (int) $this->rating));
    }
}
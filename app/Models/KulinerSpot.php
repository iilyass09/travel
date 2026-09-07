<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KulinerSpot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'tags', 'gradient', 'icon_color', 'active', 'sort'];

    protected $casts = ['active' => 'boolean', 'sort' => 'integer'];

    public function tagList(): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) $this->tags)), fn ($t) => $t !== ''));
    }
}
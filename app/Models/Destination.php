<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'gradient', 'icon', 'image', 'active', 'sort'];

    protected $casts = ['active' => 'boolean', 'sort' => 'integer'];

    public function imageUrl(): string
    {
        return $this->image ? storage_url($this->image) : '';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSpot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'gradient', 'icon_light', 'active', 'sort'];

    protected $casts = ['active' => 'boolean', 'sort' => 'integer'];
}
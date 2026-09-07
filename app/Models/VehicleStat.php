<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleStat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'sort'];

    protected $casts = ['sort' => 'integer'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalleries extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'image', 'is_active'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductGalleries;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'seller_id', 'thumbnail_image', 'min_order_qty', 'unit_type', 'serial_number', 'price', 'original_or_copy', 'descriptions'
    ];

    public function galleries()
    {
        return $this->hasMany(ProductGalleries::class, 'product_id', 'id');
    }

    public function seller_info() {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }


}

<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'attributes' => 'json',
        'other_image' => 'json',
        'status' => ProductStatus::class,
    ];

    protected $fillable = [
        'sku',
        'barcode',
        'name',
        'price',
        'stock_available',
        'attributes',
        'main_image',
        'other_image',
        'width',
        'length',
        'height',
        'kg',
        'status',
        'original_data',
    ];

    protected $appends = [
        'status_label',
    ];

    public function getStatusLabelAttribute()
    {
        return ProductStatus::fromValue($this->status)->description;
    }
}
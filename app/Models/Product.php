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
        'original_data' => 'json',
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
        'category_id',
    ];

    protected $appends = [
        'status_label',
    ];

    public function getStatusLabelAttribute()
    {
        return ProductStatus::fromValue($this->status)->description;
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;

    public const STATUS_SELECT = [
        '0' => 'รอแปลภาษา',
        '1' => 'รอดึงรูปภาพ',
        '2' => 'แสดง',
        '3' => 'ซ่อน',
    ];

    public $table = 'products';

    public $orderable = [
        'id',
        'sku',
        'barcode',
        'name',
        'price',
        'stock_available',
        'attributes',
        'width',
        'length',
        'height',
        'kg',
        'status',
    ];

    public $filterable = [
        'id',
        'sku',
        'barcode',
        'name',
        'price',
        'stock_available',
        'attributes',
        'width',
        'length',
        'height',
        'kg',
        'status',
    ];

    protected $appends = [
        'main_image',
        'other_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sku',
        'barcode',
        'name',
        'price',
        'stock_available',
        'attributes',
        'width',
        'length',
        'height',
        'kg',
        'status',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function getMainImageAttribute()
    {
        return $this->getMedia('product_main_image')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getOtherImageAttribute()
    {
        return $this->getMedia('product_other_image')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

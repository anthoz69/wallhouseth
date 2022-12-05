<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Popup extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;

    protected static function booted()
    {
        static::saving(function ($popup) {
            $popup->key = Str::random();
        });
    }

    public const ENABLE_RADIO = [
        '1' => 'ปิด',
        '2' => 'เปิด',
    ];

    public $table = 'popups';

    public $orderable = [
        'id',
        'url',
        'enable',
    ];

    public $filterable = [
        'id',
        'url',
        'enable',
    ];

    protected $appends = [
        'bg',
    ];

    protected $fillable = [
        'url',
        'enable',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth = 120;
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

    public function getBgAttribute()
    {
        return $this->getMedia('popup_bg')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getEnableLabelAttribute($value)
    {
        return static::ENABLE_RADIO[$this->enable] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeIsEnable($query)
    {
        return $query->where('enable', 2);
    }
}

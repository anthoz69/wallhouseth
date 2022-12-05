<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slide extends Model implements HasMedia
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;

    protected static function booted()
    {
        static::addGlobalScope('seq', function (Builder $builder) {
            $builder->orderBy('sort')
                ->oldest();
        });
    }

    public const NEW_TAB_RADIO = [
        '1' => 'New Tab',
        '2' => 'Same Tab',
    ];

    public const ENABLE_RADIO = [
        '1' => 'เปิด',
        '2' => 'ปิด',
    ];

    public $table = 'slides';

    public $orderable = [
        'id',
        'enable',
        'sort',
    ];

    public $filterable = [
        'id',
        'enable',
        'sort',
    ];

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'enable',
        'sort',
        'url',
        'new_tab',
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

    public function getEnableLabelAttribute($value)
    {
        return static::ENABLE_RADIO[$this->enable] ?? null;
    }

    public function getImageAttribute()
    {
        return $this->getMedia('slide_image')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getNewTabLabelAttribute($value)
    {
        return static::NEW_TAB_RADIO[$this->new_tab] ?? null;
    }

    public function getIsNewTabAttribute()
    {
        return $this->new_tab == "1";
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeIsEnable($query)
    {
        return $query->where('enable', 1);
    }
}

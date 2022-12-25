<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Collection;

class Category extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'categories';

    public const STATUS_SELECT = [
        '0' => 'รอแปลภาษา',
        '1' => 'แสดง',
    ];

    public $orderable = [
        'id',
        'name',
        'category_id_map',
        'status',
    ];

    public $filterable = [
        'id',
        'name',
        'category_id_map',
        'status',
    ];

    protected $fillable = [
        'name',
        'category_id_map',
        'status',
        'original_data',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    private $descendants = [];

    // One level child
    public function child(): HasMany
    {
        return $this->hasMany(self::class, 'category_id_map');
    }

    // Recursive children
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'category_id_map')->with('children');
    }

    // One level parent
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'category_id_map');
    }

    // Recursive parents
    public function parents(): BelongsTo
    {
        return $this->belongsTo(self::class, 'category_id_map')->with('parent');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeOnlyParent($query)
    {
        return $query->where('category_id_map', null);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function hasChildren()
    {
        if ($this->children->count()) {
            return true;
        }

        return false;
    }

    public function scopeCanShow($query)
    {
        return $query->where('status', 1);
    }
}

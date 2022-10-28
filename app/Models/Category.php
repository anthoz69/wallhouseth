<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // One level child
    public function child(): HasMany
    {
        return $this->hasMany(self::class, 'parent_category_id');
    }

    // Recursive children
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_category_id')->with('children');
    }

    // One level parent
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_category_id');
    }

    // Recursive parents
    public function parents(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_category_id')->with('parent');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}

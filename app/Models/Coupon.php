<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Coupon extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'coupons';

    public $orderable = [
        'id',
        'name',
        'code',
        'amount',
        'price',
    ];

    public $filterable = [
        'id',
        'name',
        'code',
        'amount',
        'price',
    ];

    protected $fillable = [
        'name',
        'code',
        'amount',
        'price',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function isAvailable()
    {
        return $this->amount >= 1;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function findCoupon(string $code)
    {
        return self::where('code', $code)
            ->where('amount', '>', 0)
            ->first();
    }
}

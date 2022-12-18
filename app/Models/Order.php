<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const PAYMENT_STATUS_SELECT = [
        '1' => 'รอชำระเงิน',
        '2' => 'รอตรวจสอบ',
        '3' => 'ชำระแล้ว',
    ];

    public const STATUS_SELECT = [
        '1' => 'รอตรวจสอบ',
        '2' => 'เตรียมจัดส่ง',
        '3' => 'จัดส่งแล้ว',
    ];

    public const COUNTRY_SELECT = [
        'th' => 'ไทย',
    ];

    public $table = 'orders';

    public $orderable = [
        'id',
        'owner.name',
        'owner.email',
        'ref',
        'status',
        'payment_status',
    ];

    public $filterable = [
        'id',
        'owner.name',
        'owner.email',
        'ref',
        'status',
        'payment_status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'owner_id',
        'ref',
        'status',
        'payment_status',
        'payment_detail',
        'shippop_ref',
        'shippop_detail',
        'courier_code',
        'courier_price',
        'bill_name',
        'bill_phone',
        'bill_country',
        'bill_address',
        'bill_amphoe',
        'bill_district',
        'bill_province',
        'bill_zipcode',
        'shipping_name',
        'shipping_phone',
        'shipping_country',
        'shipping_address',
        'shipping_amphoe',
        'shipping_district',
        'shipping_province',
        'shipping_zipcode',
        'tracking',
    ];

    protected $with = [
        'items',
    ];

    protected $casts = [
        'shippop_detail' => 'json',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('subTotal');
    }

    public function getGrandTotalAttribute()
    {
        return $this->total + $this->courier_price;
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function getBillCountryLabelAttribute($value)
    {
        return static::COUNTRY_SELECT[$this->bill_country] ?? null;
    }

    public function getShippingCountryLabelAttribute($value)
    {
        return static::COUNTRY_SELECT[$this->shipping_country] ?? null;
    }

    public function getPaymentStatusLabelAttribute($value)
    {
        return static::PAYMENT_STATUS_SELECT[$this->payment_status] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

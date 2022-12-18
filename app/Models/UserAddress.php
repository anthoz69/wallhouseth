<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const IS_BILL_SAME_ADDRESS_RADIO = [
        '1' => 'ที่อยู่เดียวกัน',
        '2' => 'ที่อยู่อื่น',
    ];

    public const IS_MAIN_RADIO = [
        '1' => 'ที่อยู่หลัก',
        '2' => 'ไม่ใช่ที่อยู่หลัก',
    ];

    public $table = 'user_addresses';

    public $orderable = [
        'id',
        'bill_name',
        'bill_address',
        'bill_district',
        'bill_amphoe',
        'bill_province',
        'bill_zipcode',
        'bill_phone',
        'owner.name',
        'owner.email',
    ];

    public $filterable = [
        'id',
        'bill_name',
        'bill_address',
        'bill_district',
        'bill_amphoe',
        'bill_province',
        'bill_zipcode',
        'bill_phone',
        'owner.name',
        'owner.email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'owner_id',
        'name',
        'is_main',
        'is_bill_same_address',
        'bill_name',
        'bill_phone',
        'bill_country',
        'bill_address',
        'bill_district',
        'bill_amphoe',
        'bill_province',
        'bill_zipcode',

        'shipping_name',
        'shipping_phone',
        'shipping_country',
        'shipping_address',
        'shipping_district',
        'shipping_amphoe',
        'shipping_province',
        'shipping_zipcode',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsBillSameAddressLabelAttribute($value)
    {
        return static::IS_BILL_SAME_ADDRESS_RADIO[$this->is_bill_same_address] ?? null;
    }

    public function getBillCountryLabelAttribute($value)
    {
        return Order::COUNTRY_SELECT[$this->bill_country] ?? null;
    }

    public function getShippingCountryLabelAttribute($value)
    {
        return Order::COUNTRY_SELECT[$this->shipping_country] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

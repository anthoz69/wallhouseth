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

    public $table = 'user_addresses';

    public $orderable = [
        'id',
        'name',
        'address',
        'district',
        'amphoe',
        'province',
        'zipcode',
        'phone',
        'owner.name',
        'owner.email',
    ];

    public $filterable = [
        'id',
        'name',
        'address',
        'district',
        'amphoe',
        'province',
        'zipcode',
        'phone',
        'owner.name',
        'owner.email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'district',
        'amphoe',
        'province',
        'zipcode',
        'phone',
        'owner_id',
        'bill_address',
        'bill_district',
        'bill_amphoe',
        'bill_province',
        'bill_zipcode',
        'bill_phone',
        'is_bill_same_address',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsBillSameAddressLabelAttribute($value)
    {
        return static::IS_BILL_SAME_ADDRESS_RADIO[$this->is_bill_same_address] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

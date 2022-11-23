<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_access',
            ],
            [
                'id'    => 23,
                'title' => 'category_create',
            ],
            [
                'id'    => 24,
                'title' => 'category_edit',
            ],
            [
                'id'    => 25,
                'title' => 'category_show',
            ],
            [
                'id'    => 26,
                'title' => 'category_delete',
            ],
            [
                'id'    => 27,
                'title' => 'category_access',
            ],
            [
                'id'    => 28,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 29,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 30,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 31,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 32,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 33,
                'title' => 'slide_create',
            ],
            [
                'id'    => 34,
                'title' => 'slide_edit',
            ],
            [
                'id'    => 35,
                'title' => 'slide_show',
            ],
            [
                'id'    => 36,
                'title' => 'slide_delete',
            ],
            [
                'id'    => 37,
                'title' => 'slide_access',
            ],
            [
                'id'    => 38,
                'title' => 'banner_create',
            ],
            [
                'id'    => 39,
                'title' => 'banner_edit',
            ],
            [
                'id'    => 40,
                'title' => 'banner_show',
            ],
            [
                'id'    => 41,
                'title' => 'banner_delete',
            ],
            [
                'id'    => 42,
                'title' => 'banner_access',
            ],
            [
                'id'    => 43,
                'title' => 'user_address_create',
            ],
            [
                'id'    => 44,
                'title' => 'user_address_edit',
            ],
            [
                'id'    => 45,
                'title' => 'user_address_show',
            ],
            [
                'id'    => 46,
                'title' => 'user_address_delete',
            ],
            [
                'id'    => 47,
                'title' => 'user_address_access',
            ],
            [
                'id'    => 48,
                'title' => 'order_create',
            ],
            [
                'id'    => 49,
                'title' => 'order_edit',
            ],
            [
                'id'    => 50,
                'title' => 'order_show',
            ],
            [
                'id'    => 51,
                'title' => 'order_delete',
            ],
            [
                'id'    => 52,
                'title' => 'order_access',
            ],
            [
                'id'    => 53,
                'title' => 'order_detail_create',
            ],
            [
                'id'    => 54,
                'title' => 'order_detail_edit',
            ],
            [
                'id'    => 55,
                'title' => 'order_detail_show',
            ],
            [
                'id'    => 56,
                'title' => 'order_detail_delete',
            ],
            [
                'id'    => 57,
                'title' => 'order_detail_access',
            ],
            [
                'id'    => 58,
                'title' => 'setting_access',
            ],
        ];

        Permission::insert($permissions);
    }
}

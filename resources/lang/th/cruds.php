<?php

return [
    'userManagement' => [
        'title'          => 'จัดการผู้ใช้',
        'title_singular' => 'จัดการผู้ใช้',
    ],
    'permission'     => [
        'title'          => 'การอนุญาต',
        'title_singular' => 'การอนุญาต',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'หน้าที่',
        'title_singular' => 'หน้าที่',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'ผู้ใช้งาน',
        'title_singular' => 'ผู้ใช้งาน',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'locale'                   => 'Locale',
            'locale_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'product'        => [
        'title'          => 'สินค้า',
        'title_singular' => 'สินค้า',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'sku'                    => 'Sku',
            'sku_helper'             => ' ',
            'barcode'                => 'Barcode',
            'barcode_helper'         => ' ',
            'name'                   => 'ชื่อสินค้า',
            'name_helper'            => ' ',
            'price'                  => 'ราคา',
            'price_helper'           => ' ',
            'stock_available'        => 'สต็อก',
            'stock_available_helper' => ' ',
            'features'               => 'คุณสมบัติ',
            'features_helper'        => 'คุณสมบัติสินค้า ( คั่นด้วย , )',
            'main_image'             => 'รูปหลัก',
            'main_image_helper'      => ' ',
            'other_image'            => 'รูปอื่นๆ',
            'other_image_helper'     => ' ',
            'width'                  => 'ยาว',
            'width_helper'           => ' ',
            'length'                 => 'กว้าง',
            'length_helper'          => ' ',
            'height'                 => 'สูง',
            'height_helper'          => ' ',
            'kg'                     => 'น้ำหนัก (กิโลกรัม)',
            'kg_helper'              => ' ',
            'status'                 => 'สถานะ',
            'status_helper'          => ' ',
            'original_data'          => 'Original Data',
            'original_data_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'categories'             => 'หมวดหมู่',
            'categories_helper'      => ' ',
            'excel'                  => 'ไฟล์ Excel',
            'excel_helper'           => '',
        ],
    ],
    'category'       => [
        'title'          => 'หมวดหมู่',
        'title_singular' => 'หมวดหมู่',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'ชื่อ',
            'name_helper'            => ' ',
            'category_id_map'        => 'หมวดหมู่หลัก',
            'category_id_map_helper' => ' ',
            'status'                 => 'สถานะ',
            'status_helper'          => ' ',
            'original_data'          => 'Original Data',
            'original_data_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'coupon'         => [
        'title'          => 'คูปอง',
        'title_singular' => 'คูปอง',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'ชื่อ',
            'name_helper'       => ' ',
            'code'              => 'Code คูปอง',
            'code_helper'       => ' ',
            'amount'            => 'จำนวน',
            'amount_helper'     => ' ',
            'price'             => 'ส่่วนลด (บาท)',
            'price_helper'      => 'ราคาส่วนลดจะคำนวนจากยอดในใบเสร็จ และไม่รวมกับค่าขนส่ง',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'slide'          => [
        'title'          => 'สไลด์',
        'title_singular' => 'สไลด์',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'enable'            => 'เปิด/ปิด',
            'enable_helper'     => ' ',
            'sort'              => 'ลำดับ',
            'sort_helper'       => ' ',
            'image'             => 'รูปภาพ',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'url'               => 'ลิงก์',
            'url_helper'        => ' ',
            'new_tab'           => 'New Tab',
            'new_tab_helper'    => ' ',
        ],
    ],
    'banner'         => [
        'title'          => 'แบนเนอร์',
        'title_singular' => 'แบนเนอร์',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'enable'            => 'เปิด/ปิด',
            'enable_helper'     => ' ',
            'sort'              => 'ลำดับ',
            'sort_helper'       => ' ',
            'image'             => 'รูปภาพ',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'url'               => 'ลิงก์',
            'url_helper'        => ' ',
            'new_tab'           => 'New Tab',
            'new_tab_helper'    => ' ',
        ],
    ],
    'userAddress'    => [
        'title'          => 'ที่อยู่',
        'title_singular' => 'ที่อยู่',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'name'                        => 'ชื่อสถานที่',
            'name_helper'                 => ' ',
            'bill_name'                   => 'ชื่อ-สกุล',
            'bill_name_helper'            => ' ',
            'bill_phone'                  => 'เบอร์โทร',
            'bill_phone_helper'           => ' ',
            'bill_country'                => 'ประเทศ',
            'bill_country_helper'         => ' ',
            'bill_address'                => 'ที่อยู่',
            'bill_address_helper'         => ' ',
            'bill_district'               => 'ตำบล',
            'bill_district_helper'        => ' ',
            'bill_amphoe'                 => 'อำเภอ',
            'bill_amphoe_helper'          => ' ',
            'bill_province'               => 'จังหวัด',
            'bill_province_helper'        => ' ',
            'bill_zipcode'                => 'รหัสไปรษณีย์',
            'bill_zipcode_helper'         => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'owner'                       => 'ผู้ใช้',
            'owner_helper'                => ' ',
            'shipping_name'               => 'ชื่อ-สกุล',
            'shipping_name_helper'        => ' ',
            'shipping_phone'              => 'เบอร์โทรศัพท์',
            'shipping_phone_helper'       => ' ',
            'shipping_country'            => 'ประเทศ',
            'shipping_country_helper'     => ' ',
            'shipping_address'            => 'ที่อยู่ใบเสร็จ',
            'shipping_address_helper'     => ' ',
            'shipping_district'           => 'ตำบล',
            'shipping_district_helper'    => ' ',
            'shipping_amphoe'             => 'อำเภอ',
            'shipping_amphoe_helper'      => ' ',
            'shipping_province'           => 'จังหวัด',
            'shipping_province_helper'    => ' ',
            'shipping_zipcode'            => 'รหัสไปรษณีย์',
            'shipping_zipcode_helper'     => ' ',
            'is_main'                     => 'ที่อยู่หลัก',
            'is_main_helper'              => ' ',
            'is_bill_same_address'        => 'ที่อยู่ออกใบเสร็จ',
            'is_bill_same_address_helper' => 'หากเลือกที่อยู่อื่นกรุณากรอกด้านล่าง',
        ],
    ],
    'order'          => [
        'title'          => 'ออเดอร์',
        'title_singular' => 'ออเดอร์',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'owner'                 => 'ผู้ใช้',
            'owner_helper'          => ' ',
            'ref'                   => 'เลขที่ใบเสร็จ',
            'ref_helper'            => ' ',
            'status'                => 'สถานะ',
            'status_helper'         => ' ',
            'payment_status'        => 'สถานะการชำระ',
            'payment_status_helper' => ' ',
            'payment_detail'        => 'ข้อมูลการชำระเงิน',
            'payment_detail_helper' => 'รายละเอียดการชำระเงินจาก Ksher',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'shippop_detail'        => 'ข้อมูลขนส่ง',
            'shippop_detail_helper' => ' ',
            'shippop_ref'           => 'เลขที่ขนส่ง',
            'shippop_ref_helper'    => ' ',
            'tracking'              => 'เลขพัสดุ',
            'tracking_helper'       => ' ',
        ],
    ],
    'orderDetail'    => [
        'title'          => 'รายละเอียดออเดอร์',
        'title_singular' => 'รายละเอียดออเดอร์',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'order'             => 'ออเดอร์',
            'order_helper'      => ' ',
            'product'           => 'สินค้า',
            'product_helper'    => ' ',
            'amount'            => 'จำนวน',
            'amount_helper'     => ' ',
            'price'             => 'ราคา',
            'price_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting'        => [
        'title'          => 'ตั้งค่า',
        'title_singular' => 'ตั้งค่า',
    ],
    'popup'          => [
        'title'          => 'Popup',
        'title_singular' => 'Popup',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'key'               => 'Key',
            'key_helper'        => ' ',
            'bg'                => 'Bg',
            'bg_helper'         => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'enable'            => 'Enable',
            'enable_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

];

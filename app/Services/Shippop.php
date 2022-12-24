<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Shippop
{
    const DOMAIN = 'https://mkpservice.shippop.dev/';

    /**
     * @throws GuzzleException
     */
    public function getPriceList(array $to, array $parcel)
    {
        $client = (new Client)->post(self::DOMAIN . 'pricelist/', [
            'form_params' => [
                'api_key' => config('app.shippop_key'),
                'data'    => [
                    [
                        'from'    => [
                            'name'     => 'บริษัท โชด้า คอร์ปอเรชั่น จำกัด',
                            'tel'      => '0888888888',
                            'address'  => '164/36 หมู่บ้าน บางพลีซิตี้ หมู่ที่ 10 ซอยบางปลา 20',
                            'state'    => 'บางปลา',
                            'district' => 'บางพลี',
                            'province' => 'สมุทรปราการ',
                            'postcode' => '10540',
                        ],
                        'to'      => [
                            'name'     => $to['name'],
                            'tel'      => $to['phone'],
                            'address'  => $to['address'],
                            'state'    => $to['district'],
                            'district' => $to['amphoe'],
                            'province' => $to['province'],
                            'postcode' => $to['zipcode'],
                        ],
                        'parcel'  => [
                            'name'    => 'กล่องสินค้า',
                            'weight'  => $this->getWeight($parcel['weight']),
                            'width'   => $parcel['width'],
                            'length'  => $parcel['length'],
                            'height'  => $parcel['height'],
                            'default' => '0',
                        ],
                        'showall' => 0,
                    ],
                ],
            ],
        ]);

        return json_decode($client->getBody(), true);
    }

    public function createBooking(Order $order)
    {
        $items = $order->items;
        $products = $items->map(function ($item) {
            return [
                'product_code' => $item->product->id,
                'name'         => $item->product->name,
                'weight'       => $this->getWeight($item->product->kg),
            ];
        });
        $client = (new Client)->post(self::DOMAIN . 'booking/', [
            'form_params' => [
                'api_key' => config('app.shippop_key'),
                'email'   => 'shoda3plus@gmail.com',
                'data'    => [
                    [
                        'from'         => [
                            'name'     => 'บริษัท โชด้า คอร์ปอเรชั่น จำกัด',
                            'tel'      => '0888888888',
                            'address'  => '164/36 หมู่บ้าน บางพลีซิตี้ หมู่ที่ 10 ซอยบางปลา 20',
                            'state'    => 'บางปลา',
                            'district' => 'บางพลี',
                            'province' => 'สมุทรปราการ',
                            'postcode' => '10540',
                        ],
                        'to'           => [
                            'name'     => $order->shipping_name,
                            'tel'      => $order->shipping_phone,
                            'address'  => $order->shipping_address,
                            'state'    => $order->shipping_district,
                            'district' => $order->shipping_amphoe,
                            'province' => $order->shipping_province,
                            'postcode' => $order->shipping_zipcode,
                        ],
                        'parcel'       => [
                            'name'    => 'กล่องสินค้า',
                            'weight'  => $this->getWeight($items->sum('product.kg')),
                            'width'   => $items->sum('product.width'),
                            'length'  => $items->sum('product.length'),
                            'height'  => $items->sum('product.height'),
                            'default' => '0',
                        ],
                        'product'      => $products,
                        'courier_code' => $order->courier_code,
                        'remark'       => "ออเดอร์ #$order->ref",
                    ],
                ],
            ],
        ]);

        $response = json_decode($client->getBody(), true);
        if ($response['status'] !== true) {
            throw new \Exception('ไม่สามารถสร้างออเดอร์ของ Shippop');
        }

        return $response;
    }

    public function confirmBooking($purchaseId)
    {
        $client = (new Client)->post(self::DOMAIN . 'confirm/', [
            'form_params' => [
                'api_key'     => config('app.shippop_key'),
                'email'       => 'shoda3plus@gmail.com',
                'purchase_id' => $purchaseId,
            ],
        ]);
        $response = json_decode($client->getBody(), true);

        if ($response['status'] !== true && $response['message'] === 'Confirm already') {
            return true;
        }

        if ($response['status'] !== true) {
            throw new \Exception('ยืนยันออเดอร์ Shippop ไม่สำเร็จ');
        }

        return true;
    }

    public function getLabel($purchaseId)
    {
        $client = (new Client)->post(self::DOMAIN . 'label/', [
            'form_params' => [
                'api_key'     => config('app.shippop_key'),
                'purchase_id' => $purchaseId,
                'type'        => 'pdf',
            ],
        ]);
        $response = json_decode($client->getBody(), true);
        if ($response['status'] !== true) {
            throw new \Exception('เรียกข้อมูลใบปะหน้าไม่สำเร็จ กรุณาเปลี่ยนสถานะเป็นสำเร็จก่อน');
        }

        return $response;
    }

    public function checkStatus($tracking)
    {
        $client = (new Client)->post(self::DOMAIN . 'tracking/', [
            'form_params' => [
                'api_key'       => config('app.shippop_key'),
                'tracking_code' => $tracking,
            ],
        ]);
        $response = json_decode($client->getBody(), true);
        if ($response['status'] !== true) {
            throw new \Exception('ไม่สามารถเช็คสถานะได้');
        }

        return $response;
    }

    /**
     * @param $weight
     * @return string
     */
    public function getWeight($weight): string
    {
        return bcmul($weight, 100, 0);
    }
}

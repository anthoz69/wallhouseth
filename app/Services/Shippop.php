<?php

namespace App\Services;

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

    /**
     * @param $weight
     * @return string
     */
    public function getWeight($weight): string
    {
        return bcmul($weight, 100, 0);
    }
}

<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ksherPaymentService
{
    private KsherPay $ksherPay;

    public function __construct(KsherPay $ksherPay)
    {
        $this->ksherPay = $ksherPay;
    }

    public function infoOrder($orderRef)
    {
        $responseKsher = $this->ksherPay->gateway_order_query([
            'mch_order_no' => $orderRef,
        ]);
        $response = json_decode($responseKsher, true);

        return $response;
    }

    public function createOrder($order)
    {
        if (app()->environment(['production'])) {
            $amount = bcmul($order->grand_total, 100);
        } else {
            // 1 บาท
            $amount = bcmul(1, 100);
        }
        $data = [
            'channel_list'          => 'promptpay',
            'fee_type'              => 'THB',
            'mch_code'              => $order->ref,
            'mch_order_no'          => $order->ref,
            'refer_url'             => route('index'),
            'total_fee'             => $amount,
            'device'                => 'PC',
            'mch_redirect_url'      => route('user.checkout.complete', ['ref' => $order->ref]),
            'mch_redirect_url_fail' => route('user.dashboard',
                ['tab' => 'orders', 'order' => $order->id, 'ks' => 'fail', 'ref' => $order->ref]),
            'mch_notify_url' => route('webhook.ksher', ['key' => config('app.ksher_secret_webhook')]),
            'product_name'          => $order->ref,
            'lang' => 'th',
        ];
        $gateway_pay_response = $this->ksherPay->gateway_pay($data);
        $response = json_decode($gateway_pay_response, true);
        if ($response['code'] != 0 && $response['msg'] != 'SUCCESS') {
            throw new \Exception("create order not success");
        }

        return $response;
    }

    function fixed($number, $places = 2)
    {
        return number_format((float) $number, $places, '.', '');
    }
}

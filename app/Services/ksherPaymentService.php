<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ksherPaymentService
{
    private $domain;
    private $token;
    const CREATE_ORDER = "/api/v1/redirect/orders";
    const INFO_ORDER = "/api/v1/redirect/orders/%s";
    const DELETE_ORDER = "/api/v1/redirect/orders/%s";

    public function __construct()
    {
        $this->domain = config('app.ksher_gateway_domain');
        $this->token = config('app.ksher_gateway_token');
    }

    private function parseData($data)
    {
        ksort($data);
        $message = '';
        foreach ($data as $key => $value) {
            if (is_bool($value)) {
                if ($value) {
                    $value = "True";
                } else {
                    $value = "False";
                }
            }

            $message .= $key . $value;
        }

        return mb_convert_encoding($message, "UTF-8");
    }

    public function sign($endpoint, $data)
    {
        $message = $endpoint . $this->parseData($data);

        return hash_hmac(
            "sha256",
            $message,
            $this->token
        );
    }

    public function verify_sign($url, $data): bool
    {
        $resp_sign = $data["signature"] ?? '';
        unset($data['signature']);
        unset($data["log_entry_url"]);
        $message = $url . $this->parseData($data);
        $encoded_sign = strtoupper(hash_hmac(
            "sha256",
            $message,
            $this->token
        ));

        return $encoded_sign == $resp_sign;
    }

    public function infoOrder($orderRef)
    {
        $url = sprintf($this->domain . self::INFO_ORDER, $orderRef);
        $endpoint = sprintf(self::INFO_ORDER, $orderRef);
        $data = [
            'timestamp' => (string) Carbon::now('UTC')->timestamp,
        ];
        $data['signature'] = $this->sign($endpoint, $data);
        $response = Http::get($url, $data)->throw()->json();
        if ($this->verify($endpoint, $response)) {
            return $response;
        } else {
            throw new \Exception("error verify signature");
        }
    }

    public function createOrder($order)
    {
        $url = $this->domain . self::CREATE_ORDER;
        $data = [
            'merchant_order_id' => $order->ref,
            'amount'            => bcmul($order->grand_total, 100),
            'timestamp'         => (string) Carbon::now('UTC')->timestamp,
            'redirect_url'      => route('user.checkout.complete', ['ref' => $order->ref]),
            'redirect_url_fail' => route('user.order', ['order' => $order->id, 'ks' => 'fail', 'ref' => $order->ref]),
            'lang'              => 'th',
            'product_name'      => $order->ref,
        ];
        $data['signature'] = $this->sign(self::CREATE_ORDER, $data);
        $response = Http::post($url, $data)->throw()->json();
        if ($response['error_code'] !== "SUCCESS") {
            throw new \Exception("create order not success");
        }
        if ($this->verify(self::CREATE_ORDER, $response)) {
            return $response;
        } else {
            throw new \Exception("error verify signature");
        }
    }

    public function deleteOrder($orderRef)
    {
        $url = sprintf($this->domain . self::DELETE_ORDER, $orderRef);
        $endpoint = sprintf(self::DELETE_ORDER, $orderRef);
        $data = [
            'timestamp' => (string) Carbon::now('UTC')->timestamp,
        ];
        $data['signature'] = $this->sign($endpoint, $data);
        $response = Http::delete($url, $data)->throw()->json();
        if ($response['error_code'] !== "SUCCESS" && $response['status'] !== 'Closed') {
            throw new \Exception("delete order not success");
        }
        if ($this->verify($endpoint, $response)) {
            return $response;
        } else {
            throw new \Exception("error verify signature");
        }
    }

    function fixed($number, $places = 2)
    {
        return number_format((float) $number, $places, '.', '');
    }

    private function verify($endpoint, $response): bool
    {
        if (strpos($endpoint, '/api/v1/finance/settlements') !== false) {
            return true;
        } else {
            if (! $this->verify_sign($endpoint, $response)) {
                return false;
            }
        }

        return true;
    }
}

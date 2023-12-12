<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\KsherPay;
use App\Services\ksherPaymentService;
use Illuminate\Http\Request;

class KsherWebhookController extends Controller
{
    private KsherPay $ksherPay;

    public function __construct(KsherPay $ksherPay)
    {
        $this->ksherPay = $ksherPay;
    }

    public function index(Request $request)
    {
        try {
            // check key for webhook
            if ($request->query('key', null) !== config('app.ksher_webhook_key')) {
                return response()->json([
                    'result' => 'FAIL',
                    'msg' => 'Verify private key invalid',
                ]);
            }

            $input = file_get_contents("php://input");
            $query = urldecode($input);
            if (!$query) {
                return response()->json([
                    'result' => 'FAIL',
                    'msg' => 'No return data',
                ]);
            }

            $data_array = json_decode($query, true);

            if (app()->environment('production')) {
                $verify = $this->ksherPay->verify_ksher_sign($data_array['data'], $data_array['sign']);
                if ($verify != 1) {
                    throw new \Exception('Verify sign error.');
                }
            }

            if ($data_array['data']['result'] !== 'SUCCESS') {
                throw new \Exception('Ksher order not success.');
            }

            // relative data
            $response = $this->ksherPay->gateway_order_query([
                'mch_order_no' => $data_array['data']['mch_order_no'],
            ]);
            $response = json_decode($response, true);

            if ($response['result'] !== "SUCCESS") {
                return response()->json([
                    'result' => 'FAIL',
                    'msg' => 'status not paid.',
                ]);
            }

            $order = Order::where('ref', $data_array['data']['mch_order_no'])
                ->whereIn('payment_status', [1, 2])
                ->first();

            if ($order) {
                $order->payment_status = 3;
                $order->payment_detail = $response;
                $order->save();
            }

            return response()->json([
                'result' => 'SUCCESS',
                'msg' => 'OK',
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'result' => 'FAIL',
                'msg' => 'Internal server error.',
            ]);
        }
    }
}

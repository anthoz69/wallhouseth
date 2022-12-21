<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ksherPaymentService;
use Illuminate\Http\Request;

class KsherWebhookController extends Controller
{
    public function index(Request $request)
    {
        try {
            // check key for webhook
            if ($request->query('key', null) !== config('app.ksher_webhook_key')) {
                return response()->json([
                    'status'  => false,
                    'message' => 'webhook token invalid.',
                ], 401);
            }

            $order_id = $request->query('instance', null);
            $message = $request->query('message', null);

            // check message type if not order paid return and not process
            if (! empty($order_id) && trim($message) !== "Order Paid") {
                return response()->json([
                    'status'  => true,
                    'message' => 'webhook received. but status is ' . $message,
                ], 400);
            }

            // verify sign key
            $endpoint = route('webhook.ksher', ['key' => config('app.ksher_webhook_key')]);
            $ksher = new ksherPaymentService();
            if (! $ksher->verify_sign($endpoint, $request->only([
                'type', 'instance', 'code', 'message', 'signature',
            ]))) {
                return response()->json([
                    'status'  => false,
                    'message' => 'webhook verify sign invalid',
                ], 400);
            }

            // relative data
            $response = $ksher->infoOrder($order_id);
            if ($response['status'] !== "Paid") {
                return response()->json([
                    'status'  => false,
                    'message' => 'order not paid',
                ], 400);
            }

            $order = Order::where('ref', $order_id)
                ->where('payment_status', 1)
                ->first();

            if ($order) {
                $order->status = 3;
                $order->payment_detail = array_merge($order->meta, $response);
                $order->save();
            }


            return response()->json([
                'status'  => true,
                'message' => 'webhook received.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}

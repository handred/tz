<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Good;
use App\Http\Requests\CreateOrderRequest;
use App\Order;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Description of CreateOrder
 *
 * @author Alexey
 */
class OrderController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function create(CreateOrderRequest $request) {
        $json = $request->input();

        $order_result = [
            'statusId' => Order::STATUS_NEW,
            'userId' => $request->user()->id
        ];
        $order = Order::updateOrCreate($order_result, $order_result);

        foreach ($json['items'] as $item) {

            $good = Good::find($item['id']);
            Cart::updateOrCreate(
                    [
                'orderId' => $order->id,
                'goodId' => $good->id,
                    ], [
                'orderId' => $order->id,
                'goodId' => $good->id,
                'amount' => $item['amount'],
                'price' => $good->price
            ]);
        }
        return $json;
    }

    public function approve(Request $request) {
        try {
            return $request->user()->approve();
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Good;
use App\Http\Requests\CreateOrderRequest;
use App\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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

        $order = Order::create([
                    'statusId' => Order::STATUS_NEW,
                    'userId' => $request->user()->id
        ]);

        foreach ($json['items'] as $item) {

            $good = Good::find($item['id']);
            Cart::create([
                'orderId' => $order->id,
                'goodId' => $good->id,
                'amount' => $item['amount'],
                'price' => $good->price
            ]);
        }
        return $json;
    }

}

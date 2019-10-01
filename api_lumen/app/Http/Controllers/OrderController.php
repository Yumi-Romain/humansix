<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends BaseController
{
    /**
     * @return Response
     */
    public function getAll() {
        $orders = Order::all();
        foreach ($orders as $order) {
            $order->customer = Customer::find($order->customer);
        }
        return response()->json($orders);
    }

    /**
     * @return Response
     */
    public function getById($id) {
        $order = Order::find($id);
        return response()->json($order);
    }
}

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Product;

class OrderController extends BaseController
{
    /**
     * @return Response
     */
    public function getAll() {
        $orders = Order::all();
        foreach ($orders as $order) {

            $order->customer = Customer::find($order->customer);
            $products = DB::table('product')
                ->join('order_product', 'order_product.product', '=', 'product.sku')
                ->select('product.sku', 'product.name', 'product.price', 'order_product.quantity')
                ->where('order_product.order', $order->id)
                ->get();

            $order->price = 0;
            foreach ($products as $product) {
                $order->price += $product->price * $product->quantity;
            }
            $order->cart = [ 'product' => $products ];
        }
        return response()->json($orders);
    }

    /**
     * @return Response
     */
    public function getById($id) {
        $order = Order::find($id);
        $order->customer = Customer::find($order->customer);
        $products = DB::table('product')
            ->join('order_product', 'order_product.product', '=', 'product.sku')
            ->select('product.sku', 'product.name', 'product.price', 'order_product.quantity')
            ->where('order_product.order', $order->id)
            ->get();

        $order->price = 0;
        foreach ($products as $product) {
            $order->price += $product->price * $product->quantity;
        }
        $order->cart = [ 'product' => $products ];
        return response()->json($order);
    }
}

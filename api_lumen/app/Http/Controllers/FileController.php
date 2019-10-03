<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Product;
use App\OrderProduct;
use App\Customer;

use Log;

class FileController extends BaseController
{

    private function xmlParser($xml) {
        
        $orders = $xml->order;
        foreach ($orders as $order) {
            FileController::orderHandler($order);
        }

        $products = $xml->product;
        foreach ($products as $product) {
            FileController::productHandler($product);
        }
        
        $customers = $xml->product;
        foreach ($customers as $customer) {
            FileController::customerHandler($customer);
        }
    }

    private function orderHandler($value) {
        $order = null;
        
        // if we have an id in the xml,
        // check if we allready have it in the DB
        if (isset($value->attributes()->id)) {
            $existante = Order::find($value->attributes()->id);
            if ($existante) {
                $order = $existante->first();
            } else {
                $order = new Order();
                $order->id = $value->attributes()->id;
            }
        }
        
        // pass others non-optionals arguments
        $order->orderDate = $value->orderDate;
        $order->status = $value->status;
        $order->customer = FileController::customerHandler($value->customer);
        
        $order->save();

        $products = $value->cart->product;
        foreach ($products as $product) {
            FileController::productHandler($product, $order->id);
        }
    }

    private function customerHandler($value) {
        $customer = Customer::updateOrCreate(
            ['id' => $value->attributes()->id],
            ['firstname' => $value->firstname, 'lastname' => $value->lastname]
        );

        $customer->fresh();

        return $customer->id;
    }

    private function productHandler($value, $orderId = null) {
        $product = Product::updateOrCreate(
            ['sku' => $value->attributes()->sku],
            ['name' => $value->name, 'price' => floatval($value->price), 'sku' => $value->attributes()->sku]
        );

        $product->fresh();

        // if the xml only contain product we 
        // call the product handler without $orderId
        if (!is_null($orderId)) {
            $orderProduct = OrderProduct::where('order', $orderId)->where('product', $product->sku)->first();
            if (!$orderProduct) {
                $orderProduct = new OrderProduct();
                $orderProduct->order = $orderId;
                $orderProduct->product = $product->sku;
                $orderProduct->quantity = $value->quantity;
                $orderProduct->save();
            } else {
                OrderProduct::where('order', $orderId)->where('product', $product->sku)
                    ->update(['quantity' => $value->quantity]);
            }
        }
    }

    /**
     * @return Response
     */
    public function handleFile(Request $request) {
        if ($request->hasFile('xml') && $request->file('xml')->isValid()) {
            $path = $request->file('xml')->path();

            if (!file_exists($path)) {
                return response('', 500);
            }

            $xml = simplexml_load_file($path);

            FileController::xmlParser($xml);

            return response('done');
        }

        return response('', 400);
    }
}

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends BaseController
{
    /**
     * @return Response
     */
    public function getAll() {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * @return Response
     */
    public function getById($id) {
        $product = Product::find($id);
        return response()->json($product);
    }
}

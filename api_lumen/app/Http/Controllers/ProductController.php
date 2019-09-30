<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Response
     */
    public function getAll() {
        $orders = DB::select('SELECT * FROM order');
        return response()->json($orders);
    }

    /**
     * @return Response
     */
    public function getById($id) {
        $orders = DB::select('SELECT * FROM order');
        return response()->json($orders);
    }
}

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends BaseController
{
    /**
     * @return Response
     */
    public function getAll() {
        $customers = Customer::all();
        return response()->json($customers);
    }

}

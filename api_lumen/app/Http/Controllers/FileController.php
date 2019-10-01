<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;

class FileController extends BaseController
{
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
            return response()->json($xml);
        }

        return response('', 400);
    }
}

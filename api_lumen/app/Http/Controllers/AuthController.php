<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;

class AuthController extends BaseController
{
    /**
     * @return Response
     */
    public function login(Request $request) {
        $user = null;
        if ($request->has(['username', 'password'])) {
            $user = User::where('username', $request->input('username'))
                ->where('password', hash('sha256', $request->input('password')))->first();
        } else {
            return response('', 400);
        }

        if (!$user) return response('', 401);

        return response($user->api_token);
    }

    /**
     * @return Response
     */
    public function renewToken(Request $request) {
        $user = $request->user();
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(32));
        $user->save();
    }

    /**
     * Register a new user
     * 
     * @return Response
     */
    public function register(Request $request) {

        if ($request->has(['username', 'password'])) {

            $username = $request->input('username');

            // check if User allready exists
            if (User::where('username', $username)->first()) {
                return response('user allready exists', 400);
            }

            // create User then save it
            $user = new User();
            $user->username = $username;
            $user->password = hash('sha256', $request->input('password'));
            $user->api_token = bin2hex(openssl_random_pseudo_bytes(32));
            $user->save();
            return response('', 200);

        }

        return response('', 400);
    }
}
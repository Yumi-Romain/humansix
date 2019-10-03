<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return 'Test technique humansix';
});


$router->group(['prefix' => '/api'], function() use ($router) {
    
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');
    
    // expose thoses routes to all users
    $router->get('/orders', 'OrderController@getAll');
    $router->get('/order/{id}', 'OrderController@getById');
    $router->get('/products', 'ProductController@getAll');
    $router->get('/product/{id}', 'ProductController@getById');
    
    // keeps thoses ones safe behind auth check
    $router->group(['middleware' => 'auth'], function() use ($router) {
        
        $router->get('/renew', 'AuthController@renewToken');
        $router->post('/createorder', 'OrderController@createOrder');
        $router->post('/uploadorder', 'FileController@handleFile');
        $router->get('/customers', 'CustomerController@getAll');

    });
});
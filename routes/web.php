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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//$router->get('/v1/{source}', 'InitController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('customers',  ['uses' => 'CustomersController@showAllCustomers']);
  
    $router->get('customers/{customerNumber}', ['uses' => 'CustomersController@showOneCustomer']);
  
    $router->post('customers', ['uses' => 'CustomersController@create']);
  
    $router->delete('customers/{id}', ['uses' => 'CustomersController@delete']);
  
    $router->put('customers/{id}', ['uses' => 'CustomersController@update']);
  });
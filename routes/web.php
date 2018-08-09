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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('customers',  ['uses' => 'CustomersController@getAll']);
  
    $router->get('customers/id/{id}', ['uses' => 'CustomersController@getByID']);
    
    $router->get('customers/lastname/{customerName}', ['uses' => 'CustomersController@getByName']);
  
    $router->post('customers', ['uses' => 'CustomersController@create']);
  
    $router->delete('customers/{id}', ['uses' => 'CustomersController@delete']);
  
    $router->put('customers/{id}', ['uses' => 'CustomersController@update']);
  });

$router->get('/Rank-Data/{plan-type}', 'CustomersController@GetRankedData'); // Return Ranked Data for {plan-type} plan types

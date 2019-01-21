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

//Oath Authentication
// Oath process

$router->group(['prefix' => 'slack'], function ($app) {
    $app->get('/login', 'SlackController@login');
    $app->get('/connect', 'SlackController@connect');
});


//This is the main Calculator App Route.
$router->post('/calculate', 'CalculatorController@index');

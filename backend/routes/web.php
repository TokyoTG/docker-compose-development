<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->group(['prefix' => 'api/v1'], function (Laravel\Lumen\Routing\Router $router) {
    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->get('/{id}', 'ProductController@show');
        $router->post('/', 'ProductController@store');
        $router->put('/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@delete');
    });

    $router->group(['prefix' => 'books'], function () use ($router) {
        $router->get('/seed', 'BookController@seedDb');
        $router->get('/', 'BookController@index');
    });
});

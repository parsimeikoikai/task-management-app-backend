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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('tasks', 'TaskController@store');            // Create a Task
    $router->get('tasks', 'TaskController@index');             // Get All Tasks
    $router->get('tasks/{id}', 'TaskController@show');         // Get a Specific Task
    $router->put('tasks/{id}', 'TaskController@update');       // Update a Task
    $router->delete('tasks/{id}', 'TaskController@destroy');   // Delete a Task
});

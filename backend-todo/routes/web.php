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
    $router->get('/tarefas', 'TarefaController@index');
    $router->get('/tarefas_subtarefas', 'TarefaController@tarefas_subtarefas');
    $router->post('/tarefas', 'TarefaController@store');
    $router->put('/tarefas/{id}', 'TarefaController@update');
    $router->delete('/tarefas/{id}', 'TarefaController@delete');

    $router->get('/subtarefas', 'SubTarefaController@index');
    $router->post('/subtarefas', 'SubTarefaController@store');
    $router->post('/subtarefas/{id}', 'SubTarefaController@update');
    $router->delete('/subtarefas/{id}', 'SubTarefaController@delete');
    
});



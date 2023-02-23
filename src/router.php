<?php

require('./src/controller/CarController.php');

$router = new \Bramus\Router\Router();

$router->get('/cars', 'CarController@index');
$router->get('/cars/{id}', 'CarController@show');
$router->post('/cars', 'CarController@store');
$router->put('/cars/{id}', 'CarController@update');
$router->delete('/cars/{id}', 'CarController@delete');

$router->get('/', function() {
   Helper::json('Welcome to the API, to access the primary endpoint go to /cars');
});

$router->set404(function() { Helper::json('Route not found', 404); });

$router->run();
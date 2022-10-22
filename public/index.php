<?php

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

$router->map('GET', '/', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'home',
], 'main-home');

/* -------------
--- DISPATCH ---
--------------*/

//Check url 
$match = $router->match();

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

// before use dispatch(), Constructor controllers need $router
$dispatcher->setControllersArguments($router);
// Dispactch
$dispatcher->dispatch();
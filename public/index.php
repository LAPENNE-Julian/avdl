<?php

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

$router->map('GET', '/', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'home',
], 'main-home');

$router->map('GET', '/contact', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'contact',
], 'main-contact');

$router->map('GET', '/mentions-legales', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'legal',
], 'main-legal');

/**
 * Anecdote
 */
$router->map('GET', '/anecdote', [
    'controller' => '\App\Controllers\AnecdoteController',
    'method' => 'browse',
], 'anecdote-browse');

$router->map('GET', '/anecdote/[i:id]', [
    'controller' => '\App\Controllers\AnecdoteController',
    'method' => 'read',
], 'anecdote-read');

/**
 * Category
 */
$router->map('GET', '/category', [
    'controller' => '\App\Controllers\CategoryController',
    'method' => 'browse',
], 'category-browse');

/* -------------
--- BACKOFFICE ---
--------------*/

/**
 * BREAD user
 */
$router->map('GET', '/backoffice/user', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'browse',
], 'backoffice-user-browse');

/**
 * BREAD anecdote
 */
$router->map('GET', '/backoffice/anecdote', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'browse',
], 'backoffice-anecdote-browse');

/**
 * BREAD category
 */
$router->map('GET', '/backoffice/category', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'browse',
], 'backoffice-category-browse');

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
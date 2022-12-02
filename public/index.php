<?php

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

$router->map('GET', '/', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'home',
], 'main-home');

$router->map('GET', '/api-documentation', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'apiDocumentation',
], 'api-documentation');

$router->map('GET', '/contact', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'contact',
], 'main-contact');

$router->map('GET', '/mentions-legales', [
    'controller' => '\App\Controllers\MainController',
    'method' => 'legal',
], 'main-legal');

/**
 * register
 */
/*$router->map('GET', '/register', [
    'controller' => '\App\Controllers\RegistrationController',
    'method' => 'register',
], 'register');

$router->map('POST', '/register', [
    'controller' => '\App\Controllers\RegistrationController',
    'method' => 'registerPost',
], 'register-post');
*/

/**
 * connection
 */
$router->map('GET', '/login', [
    'controller' => '\App\Controllers\SecurityController',
    'method' => 'login',
], 'login');

$router->map('POST', '/login', [
    'controller' => '\App\Controllers\SecurityController',
    'method' => 'loginPost',
], 'login-post');

$router->map('GET', '/logout', [
    'controller' => '\App\Controllers\SecurityController',
    'method' => 'logout',
], 'logout');

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

$router->map('GET', '/anecdote/random', [
    'controller' => '\App\Controllers\AnecdoteController',
    'method' => 'random',
], 'anecdote-random');

$router->map('GET', '/anecdote/best', [
    'controller' => '\App\Controllers\AnecdoteController',
    'method' => 'best',
], 'anecdote-best');

$router->map('GET', '/anecdote/best/[i:id]', [
    'controller' => '\App\Controllers\AnecdoteController',
    'method' => 'bestRead',
], 'anecdote-best-read');

/**
 * Category
 */
$router->map('GET', '/category', [
    'controller' => '\App\Controllers\CategoryController',
    'method' => 'browse',
], 'category-browse');

$router->map('GET', '/category/[i:id]/anecdote', [
    'controller' => '\App\Controllers\CategoryController',
    'method' => 'browseAnecdote',
], 'category-browse-anecdote');

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

$router->map('GET', '/backoffice/user/[i:id]', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'read',
], 'backoffice-user-read');

$router->map('GET', '/backoffice/user/add', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'add',
], 'backoffice-user-add');

$router->map('POST', '/backoffice/user/add', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'addPost',
], 'backoffice-user-add-post');
 
$router->map('GET', '/backoffice/user/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'edit',
], 'backoffice-user-edit');

$router->map('POST', '/backoffice/user/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'editPost',
], 'backoffice-user-edit-post');

$router->map('GET', '/backoffice/user/delete/[i:id]', [
    'controller' => '\App\Controllers\backoffice\UserController',
    'method' => 'delete',
], 'backoffice-user-delete');

/**
 * BREAD anecdote
 */
$router->map('GET', '/backoffice/anecdote', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'browse',
], 'backoffice-anecdote-browse');

$router->map('GET', '/backoffice/anecdote/[i:id]', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'read',
], 'backoffice-anecdote-read');

$router->map('GET', '/backoffice/anecdote/add', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'add',
], 'backoffice-anecdote-add');

$router->map('POST', '/backoffice/anecdote/add', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'addPost',
], 'backoffice-anecdote-add-post');
 
$router->map('GET', '/backoffice/anecdote/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'edit',
], 'backoffice-anecdote-edit');

$router->map('POST', '/backoffice/anecdote/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'editPost',
], 'backoffice-anecdote-edit-post');

$router->map('GET', '/backoffice/anecdote/delete/[i:id]', [
    'controller' => '\App\Controllers\backoffice\AnecdoteController',
    'method' => 'delete',
], 'backoffice-anecdote-delete');

/**
 * BREAD category
 */
$router->map('GET', '/backoffice/category', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'browse',
], 'backoffice-category-browse');

$router->map('GET', '/backoffice/category/[i:id]', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'read',
], 'backoffice-category-read');

$router->map('GET', '/backoffice/category/add', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'add',
], 'backoffice-category-add');

$router->map('POST', '/backoffice/category/add', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'addPost',
], 'backoffice-category-add-post');
 
$router->map('GET', '/backoffice/category/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'edit',
], 'backoffice-category-edit');

$router->map('POST', '/backoffice/category/edit/[i:id]', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'editPost',
], 'backoffice-category-edit-post');

$router->map('GET', '/backoffice/category/delete/[i:id]', [
    'controller' => '\App\Controllers\backoffice\CategoryController',
    'method' => 'delete',
], 'backoffice-category-delete');


/* -------------
--- API REQUEST ---
--------------*/

/**
 * Request anecdote
 */
$router->map('GET', '/api/anecdote', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'browse',
], 'api-anecdote-browse');

$router->map('GET', '/api/anecdote/page/[i:id]', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'browsePage',
], 'api-anecdote-browse-page');

$router->map('GET', '/api/anecdote/page', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'pageNumber',
], 'api-anecdote-page-number');

$router->map('GET', '/api/anecdote/[i:id]', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'read',
], 'api-anecdote-read');

$router->map('GET', '/api/anecdote/[i:id]/prev', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'readPrevious',
], 'api-anecdote-read-previous');

$router->map('GET', '/api/anecdote/[i:id]/next', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'readNext',
], 'api-anecdote-read-next');

$router->map('GET', '/api/anecdote/random', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'random',
], 'api-anecdote-random');

$router->map('GET', '/api/anecdote/best', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'best',
], 'api-anecdote-best');

$router->map('GET', '/api/anecdote/best/[i:id]', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'bestRead',
], 'api-anecdote-best-read');

$router->map('GET', '/api/anecdote/best/[i:id]/prev', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'bestPrevious',
], 'api-anecdote-best-previous');

$router->map('GET', '/api/anecdote/best/[i:id]/next', [
    'controller' => '\App\Controllers\api\AnecdoteController',
    'method' => 'bestNext',
], 'api-anecdote-best-next');



/**
 * Request category
 */
$router->map('GET', '/api/category', [
    'controller' => '\App\Controllers\api\CategoryController',
    'method' => 'browse',
], 'api-category-browse');

$router->map('GET', '/api/category/[i:id]/anecdote', [
    'controller' => '\App\Controllers\api\CategoryController',
    'method' => 'browseAnecdotes',
], 'api-category-browse-anecdotes');

$router->map('GET', '/api/category/[i:id]/anecdote/page/[i:idsecond]', [
    'controller' => '\App\Controllers\api\CategoryController',
    'method' => 'browsePage',
], 'api-category-browse-anecdotes-page');

$router->map('GET', '/api/category/[i:id]/anecdote/page', [
    'controller' => '\App\Controllers\api\CategoryController',
    'method' => 'pageNumber',
], 'api-category-browse-anecdotes-page-number');


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
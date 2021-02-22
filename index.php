<?php
require __DIR__ . "/vendor/autoload.php";




use CoffeeCode\Router\Router;

define("BASE", "http://localhost/Printf-Task-API");

$router = new Router(BASE);

/**
 * routes
 * The controller must be in the namespace Test\Controller
 * this produces routes for route, route/$id, route/{$id}/profile, etc.
 */
$router->namespace("App");

$router->get("/", "Root:index");


/**
 * group by routes and namespace
 * this produces routes for /admin/route and /admin/route/$id
 * The controller must be in the namespace Dash\Controller
 */
$router->group("api")->namespace("App\APi\Controller");
$router->get("/", "Root:index");
$router->post("/user/storage", "UserController:storage");

/**
 * Group Error
 * This monitors all Router errors. Are they: 400 Bad Request, 404 Not Found, 405 Method Not Allowed and 501 Not Implemented
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Coffee:notFound");

/**
 * This method executes the routes
 */
$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("/");
}
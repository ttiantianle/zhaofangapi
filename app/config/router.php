<?php

$router = $di->getRouter();

// Define your routes here

$router->handle();
$router->add('/:controller/:action/:params', [
    'namespace'=>"Home\Controllers",
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);
$router->add('/front/:controller/:action/:params', [
    'namespace'=>"Front\Controllers",
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);
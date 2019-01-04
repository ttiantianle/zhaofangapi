<?php

$router = $di->getRouter();

// Define your routes here

$router->handle();
$router->add('/:controller/:action/:params', [
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);
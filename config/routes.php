<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('cart_add', new Route('/cart/add', ['action' => 'add']));
$routes->add('cart_remove', new Route('/cart/remove', ['action' => 'remove']));
$routes->add('cart_view', new Route('/cart/view', ['action' => 'view']));

return $routes;

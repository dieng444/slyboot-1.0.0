<?php
/**
 * You don't have to change anything here. all the necessary
 * class or namespace were specified, you have just to add news routes.
 */
use Slyboot\Router\Route;
use Slyboot\Router\Router;
use Slyboot\Router\RouteCollection;

$collection = new RouteCollection();
$router  = new Router();

/**
 * Change this default route to your own
 * Note : the default route is the route which was executed
 * for the home page case. ie, the root directory of your app.
 */
$router->setDefaultRoute(new Route(
    'acme_demo_welcome',
    '/',
    array('controller' => 'Acme::Demo::welcome')
));
/**
 * Add all your news routes below
 */
$collection->addRoute(new Route(
   'acme_demo_welcome',
   '/welcome',
   array('controller' => 'Acme::Demo::welcome')
));
$collection->addRoute(new Route(
        'dram_cars_news_list',
        '/list',
        array('controller' => 'DreamCars::News::list')
));
$collection->addRoute(new Route(
        'drams_cars_news_detail',
        '/detail/:id',
        array('controller' => 'DreamCars::News::detail')
));

/**
 * Registration of all routes
 */
$router->addRouteCollections($collection);

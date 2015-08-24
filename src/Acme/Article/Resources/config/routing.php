<?php
use Slyboot\Router\Route;
use Slyboot\Router\Router;
use Slyboot\Router\RouteCollection;

$collection = new RouteCollection();

$collection->addRoute(new Route('minijournal_article_home', '/',
            array('controller' => 'Minijournal::Article::home')));

$collection->addRoute(new Route('minijournal_article_list', '/article/list',
        array('controller' => 'Minijournal::Article::home')));

$collection->addRoute(new Route('minijournal_article_detail', '/article/detail',
        array('controller' => 'Minijournal::Article::detail')));

$collection->addRoute(new Route('minijournal_article_add', '/article/add',
        array('controller' => 'Minijournal::Article::add')));

$collection->addRoute(new Route('minijournal_article_save','/article/save',
        array('controller' => 'Minijournal::Article::save')));

$collection->addRoute(new Route('minijournal_article_edit','/article/edit',
        array('controller' => 'Minijournal::Article::edit')));

$collection->addRoute(new Route('minijournal_article_delete','/article/delete',
        array('controller' => 'Minijournal::Article::delete')));

/**
 * Register all route
 */
$router  = new Router();

$router->addRouteCollections($collection);
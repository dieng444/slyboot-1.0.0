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
 * Set your app default route, see example below
 *
 * $router->setDefaultRoute(new Route('acme_article_home', '/',
 *           array('controller' => 'Acme::Article::home')));
 *
 *  The example above considers that the default route is "/",
 *  ie, the root directory of your application
 */
$router->setDefaultRoute(new Route('minijournal_article_home', '/',
            array('controller' => 'Minijournal::Article::home')));

//Add all your news routes below

$collection->addRoute(new Route('minijournal_article_list', '/article/list',
        array('controller' => 'Minijournal::Article::list')));

$collection->addRoute(new Route('minijournal_article_detail', '/article/detail/:id',
        array('controller' => 'Minijournal::Article::detail')));

$collection->addRoute(new Route('minijournal_article_add', '/article/add',
        array('controller' => 'Minijournal::Article::add')));

$collection->addRoute(new Route('minijournal_article_edit','/article/edit/:id',
        array('controller' => 'Minijournal::Article::edit')));

$collection->addRoute(new Route('minijournal_article_remove','/article/remove/:id',
        array('controller' => 'Minijournal::Article::remove')));

$collection->addRoute(new Route('minijournal_image_manager', '/image/list',
        array('controller' => 'Minijournal::Image::list')));

$collection->addRoute(new Route('minijournal_image_detail', '/image/detail/:id',
        array('controller' => 'Minijournal::Image::detail')));

$collection->addRoute(new Route('minijournal_image_add', '/image/add/:articleId',
        array('controller' => 'Minijournal::Image::add')));

$collection->addRoute(new Route('minijournal_image_save', '/image/save',
        array('controller' => 'Minijournal::Image::save')));

$collection->addRoute(new Route('minijournal_image_editr', '/image/edit/:id',
        array('controller' => 'Minijournal::Image::edit')));

$collection->addRoute(new Route('minijournal_image_remove', '/image/remove/:id',
        array('controller' => 'Minijournal::Image::remove')));

$collection->addRoute(new Route('user_login', '/login',
        array('controller' => 'Minijournal::User::login')));

$collection->addRoute(new Route('user_logout', '/logout',
        array('controller' => 'Minijournal::User::logout')));

$collection->addRoute(new Route('user_auth', '/user/auth',
        array('controller' => 'Minijournal::User::auth')));

$collection->addRoute(new Route('user_signup', '/signup',
        array('controller' => 'Minijournal::User::signup')));

$collection->addRoute(new Route('user_signup_register', '/register',
        array('controller' => 'Minijournal::User::register')));

$collection->addRoute(new Route('ws_events', '/ws/events',
        array('controller' => 'Minijournal::Appws::events')));

$collection->addRoute(new Route('ws_geo_events', '/ws/location/events',
        array('controller' => 'Minijournal::Appws::locationevents')));

$collection->addRoute(new Route('api_rss', '/rss',
        array('controller' => 'Minijournal::Rss::display')));

/**
 * Registration of all routes
 */
$router->addRouteCollections($collection);
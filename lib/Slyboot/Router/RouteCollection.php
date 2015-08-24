<?php
namespace Slyboot\Router;

use Slyboot\Router\Route;
/**
 * Class RouterCollection : Allows to add route
 * on the route collection
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class RouteCollection
{
    /**
     * Array of route
     * @var array
     */
    private $routes = array();
    /**
     * Class constructor
     */
    public function __construct()
    {

    }
    /**
     * Allows to add route
     * @param  Route $route : the route to add
     * @return void
     */
    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }
    /**
     * Returns list of route
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
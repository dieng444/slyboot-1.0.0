<?php
namespace Slyboot\Router;

use Slyboot\Router\RouteCollection;

/**
 * Class Router : Allows to add route collections
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Router
{
    /**
     * Array of RouteCollection
     * @var array
     */
    private $collections = array();
    /**
     * The default route
     */
    private $defaultRoute;
    /**
     * Allows to add a collection of route
     * @param RouteCollection $collection
     */
    public function addRouteCollections(RouteCollection $collection)
    {
        $this->collections[] = $collection;
    }
    /**
     * Returns list of Route
     * @return multitype:
     */
    public function getRouteCollections()
    {
        return $this->collections;
    }
    /**
     * Set default route
     * @param Slyboot\Router\Route $route
     * @return void
     */
    public function setDefaultRoute(Route $route)
    {
        $this->defaultRoute = $route;
    }
    /**
     * Return default route
     * @return Slyboot\Router\Route
     */
    public function getDefaultRoute()
    {
        return $this->defaultRoute;
    }
}

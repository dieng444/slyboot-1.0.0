<?php
namespace Slyboot\Router;

/**
 * Class Route : Allows to create a new route
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Route
{
    /**
     * The route name
     * @var string
     */
    private $name;
    /**
     * The route path
     * @var string
     */
    private $path;
    /**
     * The full path such as the
     * user defined it in the routing file
     * @var string
     */
    private $fullPath;
    /**
     * The route package
     * @var string
     */
    private $package;
    /**
     * The full controller name such as the
     * user defined it in the routing file
     * @var string
     */
    private $fullControllerDefinition;
    /**
     * The route query string
     * @var array
     */
    private $queryString = array();
    /**
     * The route action
     * @var string
     */
    private $action;
    /**
     * The controller vendor
     * @var string
     */
    private $vendor;
    /**
     * Classs constructor
     * @param string $name
     * @param array $controller
     */
    public function __construct($name, $fullPath, array $controller)
    {
        $this->path = "";
        $this->fullControllerDefinition = $controller['controller'];
        if ($fullPath==='/') {
            $this->path = $fullPath;
        } else {
            $pathParts = explode('/', $fullPath);
            foreach ($pathParts as $part) {
                if (strstr($part, ':')) {
                    $this->queryString[] = str_replace(':', '', $part);
                } else {
                    $this->path .= $part.'/';
                }
            }
        }
        list($vendor, $pack, $act) = explode('::', $controller['controller']);
        $this->vendor = ucfirst($vendor);
        $this->package = ucfirst($pack);
        $this->action = strtolower($act);
        $this->name = $name;
        $this->fullPath = $fullPath;
    }
    /**
     * Returns route name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Returns route path
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * Returns the full path name, such as user
     * defined it in the routing fil
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }
    /**
     * Returns the full controller definition name,
     * such as the user defined it in the routing fil
     * @return string
     */
    public function getFullControllerDefinition()
    {
        return $this->fullControllerDefinition;
    }
    /**
     * Returns route query string
     * @return array
     */
    public function getQueryString()
    {
        return $this->queryString;
    }
    /**
     * Return route vendor
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }
    /**
     * Return route package
     */
    public function getPackage()
    {
        return $this->package;
    }
    /**
     * Return route action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}

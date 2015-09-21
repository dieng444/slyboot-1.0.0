<?php
namespace Slyboot\Request;

use Slyboot\Request\HttpRequest;
use Front\AppConfigLoader;
use \Exception;

/**
 * Class Request : Manage the request
 * comming from the user.
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Request
{
    /**
     * Contain all params capted from
     * the uri (POST and GET)
     * @var array
     */
    private $request = array();
    /**
     * Contain POST params capted from the uri
     * @var array
     */
    private $post = array();
    /**
     * Contain GET params capted from the uri
     * @var array
     */
    private $get = array();
    /**
     * Contain Http Request object
     * @var string
     */
    private $http;

    public function __construct()
    {
        $this->http = new HttpRequest();
        if($this->http->getMethod()==='GET' && $this->http->getMethod()!=='POST') {
            $config = AppConfigLoader::loadConfigurations();
            foreach ($config['routingFiles'] as $file) {
                if(is_readable($file)) {
                    require $file;
                }
            }
            $collections = $router->getRouteCollections();
            $uri = $this->http->getRequestUri();
            $rel_uri = $this->http->getRelativeRequestUri();
            $script = dirname($this->http->getScriptName());
            if(sizeof($collections) > 0){
                foreach ($collections as $collection) {
                    foreach($collection->getRoutes() as $route) {
                        $tmp_path = str_replace($script,'',$route->getPath());
                        $pattern = "#".preg_quote(trim($tmp_path)) ."#i";
                       /*****************************************************
                        * This condition checks wheter the current request  *
                        * match with one of the application route.          *
                        *****************************************************/
                        if(preg_match($pattern, $rel_uri, $match)) {
                            $is_route_match = true;
                            $pos = (strlen($route->getPath()) - 1);
                            /**********Case route with parameters***********/
                            if(sizeof($route->getQueryString()) > 0){
                                $uri_query_s = substr($uri, $pos);
                                $tab_uri_query_s = explode($script,$uri_query_s);
                                $tab_uri_query_s_clean = array();
                                foreach ($tab_uri_query_s as $val) {
                                    if($val!==''){
                                        if(is_numeric($val)){
                                            if (is_float($val))
                                                $tab_uri_query_s_clean[] = (float) $val;
                                            else
                                                $tab_uri_query_s_clean[] = (int) $val;
                                        }else
                                            $tab_uri_query_s_clean[] = $val;
                                    }
                                }
                                foreach ($route->getQueryString() as $k => $val) {
                                    $this->get[$val] = $tab_uri_query_s_clean[$k];
                                }
                            }
                        }
                    }
                }
                $this->request = $this->get;
            }
        }else{
            $this->post = $this->http->getPost();
        }
        if((null!==$this->http->getGet()) && (null!==$this->http->getPost())
           && !empty($this->http->getPost())){
            $this->request = array_merge($this->http->getPost(),$this->get);
            $this->post = $this->http->getPost();
            $this->get = $this->get;
        }
    }
    /**
     *
     * Returns all data received either get or post,
     * according to the parameter datatype (get or post)
     * @return array
     */
    public function getRequest($dataType=null)
    {
        if($dataType!==null && strtoupper($dataType)==='POST')
            return $this->post;
        elseif($dataType !==null && strtoupper($dataType)==='GET')
            return $this->get;
        else
            return $this->request;
    }
    /**
     * Returns a psecific data value, according to
     * the key passed in parameter
     * @param string $key
     * @throws \Exception
     * @return string
     */
    public function getParam($key)
    {
        if(array_key_exists($key,$this->request)) {
            return $this->request[$key];
        }else{
            throw new Exception("Index \"{$key}\"
            passed to method getParam() does not exist");
        }
    }
    /**
     * Allows developper to know which http method
     * was executed
     * @param string $method
     * @throws \Exception
     * @return boolean
     */
    public function isMethod($method)
    {
        $method = strtoupper($method);
        if ($this->http->getMethod() === $method && $method === 'POST')
            return true;
        elseif ($this->http->getMethod() === $method && $method === 'GET')
          return true;
        elseif($method !== 'POST' && $method !== 'GET')
            throw new Exception("Unaccepted method {$method} passed as parameter");
        else
            return false;

    }
    /**
     * Verify either the request type is an XmlHttpRequest
     * like ajax request for example.
     * @return boolean
     */
    public function isXhr()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }
}
<?php
namespace Slyboot\Request;

/**
 * Class HttpRequest : Manage the server request
 * as an object
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class HttpRequest
{
    private $_m = null,
    $_g = null,
    $_p = null,
    $_r = null,
    $_q = null,
    $_pi = null,
    $_s = null,
    $_ru = null,
    $_rel_uri = null;

    /**
     * Class constructor, initialize all variables
     */
    public function __construct () {

        $this->_m = $_SERVER['REQUEST_METHOD'];
        $this->_g = $_GET ;
        $this->_p = $_POST;
        $this->_r = $_REQUEST;
        $this->_l = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ;
        $this->_q = $_SERVER['QUERY_STRING'] ;
        $this->_s = $_SERVER['SCRIPT_NAME'];
        $this->_ru = $_SERVER['REQUEST_URI'];
        $this->rel_uri = str_replace(dirname($this->_s), '', $this->_ru);
    }
    /**
     * Returns the httpRequest Method
     * @return mixed
     */
    public function getMethod()
    {
        return $this->_m;
    }
    /**
     * Returns the httpRequest GET infos
     * @return mixed
     */
    public function getGet()
    {
        return $this->_g;
    }
    /**
     * Returns the httpRequest POST infos
     * @return mixed
     */
    public function getPost()
    {
        return $this->_p;
    }
    /**
     * Returns the httpRequest POST and GET infos
     * @return mixed
     */
    public function request()
    {
       return $this->_r ;
    }
    /**
     * Returns the httpRequest language
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->_l;
    }
    /**
     * Returns the httpRequest query string
     * @return mixed
     */
    public function getQuery()
    {
        return $this->_q;
    }
    /**
     * Returns the httpRequest script name
     * @return mixed
     */
    public function getScriptName()
    {
        return $this->_s;
    }
    /**
     * Returns the httpRequest Uri
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->_ru;
    }
    /**
     * Returns the httpRequest relative uri
     * @return mixed
     */
    public function getRelativeRequestUri()
    {
        return $this->rel_uri;
    }
}
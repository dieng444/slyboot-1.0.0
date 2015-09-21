<?php
namespace Slyboot\Request;

/**
 * Class HttpRequest : Manage the server request
 * as an object
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 - the author
 */
class HttpRequest
{
    private $m = null;
    private $g = null;
    private $p = null;
    private $r = null;
    private $q = null;
    private $pi = null;
    private $s = null;
    private $ru = null;
    private $reluri = null;

    /**
     * Class constructor, initialize all variables
     */
    public function __construct()
    {
        $this->m = $_SERVER['REQUEST_METHOD'];
        $this->g = $_GET ;
        $this->p = $_POST;
        $this->r = $_REQUEST;
        $this->l = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ;
        $this->q = $_SERVER['QUERY_STRING'] ;
        $this->s = $_SERVER['SCRIPT_NAME'];
        $this->ru = $_SERVER['REQUEST_URI'];
        $this->reluri = str_replace(dirname($this->s), '', $this->ru);
    }
    /**
     * Returns the httpRequest Method
     * @return mixed
     */
    public function getMethod()
    {
        return $this->m;
    }
    /**
     * Returns the httpRequest GET infos
     * @return mixed
     */
    public function getGet()
    {
        return $this->g;
    }
    /**
     * Returns the httpRequest POST infos
     * @return mixed
     */
    public function getPost()
    {
        return $this->p;
    }
    /**
     * Returns the httpRequest POST and GET infos
     * @return mixed
     */
    public function request()
    {
        return $this->r ;
    }
    /**
     * Returns the httpRequest language
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->l;
    }
    /**
     * Returns the httpRequest query string
     * @return mixed
     */
    public function getQuery()
    {
        return $this->q;
    }
    /**
     * Returns the httpRequest script name
     * @return mixed
     */
    public function getScriptName()
    {
        return $this->s;
    }
    /**
     * Returns the httpRequest Uri
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->ru;
    }
    /**
     * Returns the httpRequest relative uri
     * @return mixed
     */
    public function getRelativeRequestUri()
    {
        return $this->reluri;
    }
}

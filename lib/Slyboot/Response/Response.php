<?php
namespace Slyboot\Response;

/**
 * Class Response : Send an response after
 * the request has been executed
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Response
{
    /**
     * Response to send
     * @var mixed
     */
    protected $response;
    /**
     * Class constructor
     */
    public function __construct()
    {

    }
    /**
     * Send the response
     * @param mixed response to send
     * @return mixed
     */
    public function getResponse($response)
    {
        echo $this->response = $response;
    }
    /**
     * Allows to set the returning content type
     * @param String $content
     */
    public function setContentType($content)
    {
        return header("Content-Type :".$content);
    }
}

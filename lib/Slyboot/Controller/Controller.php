<?php
namespace Slyboot\Controller;

use Slyboot\Controller\ControllerInterface;
use Slyboot\Request\Request;
use Slyboot\Request\HttpRequest;
use Slyboot\Render\TemplateRender;
use Slyboot\Templater\TwigTemplateRender;
use Slyboot\Response\Response;
use Slyboot\Logging\Auth\AuthManager;

/**
 * Class Controller : the main controller class
 * all sub controller classes inherit this class
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
Abstract class Controller implements ControllerInterface
{
    /**
     * Request object variable
     * Allows sub controllers to access data from
     * the uri or user (get and post)
     * @var Util\Requests\Request
     */
    protected $request;
    /**
     * Response object variable
     * Allows sub controller to build response
     * @var Util\Response\Response
     */
    protected $response;
    /**
     * HttpRequest variable
     * Allows sub controller to access http
     * informations.
     * @var Util\Requests\HttpRequest
     */
    protected $http;
    /**
     * Class construtor
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->user = AuthManager::getInstance();
        $this->http = new HttpRequest();
    }

    /**
     * Allows sub controller to perform redirection
     * @param string $url url on which the redirection will perform
     * @return void
     */
    public function redirect($url)
    {
        header("Location: ".$url);
    }
    /**
	 * Allows sub controller to render template
	 * @param string $view template to render
	 * @param mixed $context data or other thing
	 * to display in the template
	 * @return Slyboot\Templater\TwigTemplateRender
	 */
    public function render($name, array $context)
	{
		return TwigTemplateRender::render($name, $context);
	}
}

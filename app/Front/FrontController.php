<?php
namespace Front;

use Slyboot\Controller\Controller;
use Slyboot\Request\Request;
use Slyboot\Router\Dispatcher;

/**
 * Class FrontController : Call the dispatcher for dispatch an action
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class FrontController extends Controller
{
    public function __construct()
    {
        //Todo
    }
    /**
     * Call the dispatcher
     * @return void
     */
    public function run()
    {
        $dispatcher = new Dispatcher();
        $dispatcher->dispatch();
    }
}

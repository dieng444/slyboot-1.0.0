<?php
namespace Slyboot\Controller;

/**
 * The controller interface
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
interface ControllerInterface
{
    public function redirect($url);
    public function render($name, array $context);
}
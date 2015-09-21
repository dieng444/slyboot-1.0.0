<?php
namespace Acme\Demo\Controller;
use Slyboot\Controller\Controller;

class DemoController extends Controller
{
    public function welcomeAction()
    {
        return $this->display("Acme::Demo::Demo::welcome.html.twig",array());
    }
}
<?php
namespace DreamCars\News\Controller;

use Slyboot\Controller\Controller;

class NewsController extends Controller
{
    public function listAction()
    {
       return $this->display("DreamCars::News::News::list.html.twig", array());
    }
    public function detailAction($id)
    {
        return $this->display("DreamCars::News::News::detail.html.twig", array());
    }
}
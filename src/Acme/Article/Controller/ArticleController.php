<?php
namespace Minijournal\Article\Controller;

use Minijournal\Article\Entity\Article;
use Minijournal\Article\Html\ArticleHtml;
use Minijournal\Article\Manager\ArticleManager;
use Minijournal\Article\Cleaner\ArticleCleaner;
use Slyboot\Util\Cleaner\HtmlCleaner;
use Slyboot\Util\Cleaner\WhiteSpaceCleaner;
use Minijournal\Article\Form\ArticleForm;
use Minijournal\Image\Manager\ImageManager;
use Slyboot\Controller\Controller;
use Minijournal\Image\Entity\Image;
use Minijournal\Image\Form\ImageForm;
use Util\Response\Response;
use Exception;

/**
 * Class ArticleController : Contrôleur du bundle
 * articles, étends la class de contrôleur principale
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license Pédagogique
 */
class ArticleController extends Controller
{
    public function homeAction()
    {
        /*********************************************************
         * return $this->response->getResponse("It's work");die; *
         * var_dump($this->request->getRequest('bundle'));       *
         * *******************************************************/
        $manager = new ArticleManager();
        $viewBuilder = new ArticleHtml;
        $articles = $viewBuilder->getListView($manager->findAllByLimit(5));
        $imageManager = new ImageManager();
        $data = array();
        foreach ($articles as $article) {
            $article->setImages($imageManager->findAllBy('articleId',$article->getId()));
            $data[] = $article;
        }

        return $this->render('Minijournal::Article::Default::home.html.twig', array('articles' => $data));

    }
    public function listAction()
    {
        $manager = new ArticleManager();
        $viewBuilder = new ArticleHtml;
        $articles = $viewBuilder->getListView($manager->findAll());
		$imageManager = new ImageManager();
		$data = array();

		foreach ($articles as $article) {
		    $article->setImages($imageManager->findAllBy('articleId',$article->getId()));
		    $data[] = $article;
		}
		return $this->render('Minijournal::Article::Default::article-list.html.twig',
		                    array('articles' => $data));
    }
    public function detailAction($id)
    {
        $manager = new ArticleManager();
        $viewBuilder = new ArticleHtml;
        $article = $viewBuilder->getDetailView($manager->find($id));
        $imageManager = new ImageManager();
        $article->setImages($imageManager->findAllBy('articleId',$article->getId()));

        return $this->render('Minijournal::Article::Default::article-detail.html.twig',
                            array('article' => $article));

    }
    public function addAction()
    {
        //header("HTTP/1.0 404 Not Found");die;
        if ($this->user->isConnected()){
            if ($this->user->isGrantRole('ROLE_EDITOR')) {
                if ($this->request->isMethod('post')) {
                    $cleanData = ArticleCleaner::cleanup(
                                                    array(new HtmlCleaner,
                                                          new WhiteSpaceCleaner),
                                                          $this->request->getRequest('post'));
                    $article = new Article($cleanData);
                    $form = new ArticleForm($article);
                    $manager = new ArticleManager();
                    if($form->isValid()){
                        $manager->save($article);
                        $id = $manager->lastInserId();
                        $errors = array();
                        if($article->getId()!==null){
                            $this->redirect("/article/detail/{$article->getId()}");
                        }else
                            $this->redirect("/article/detail/{$id}");
                    }else
                        return $this->render('Minijournal::Article::Default::article-form.html.twig',
                                            array('form' => $form));
                }else
                    return $this->render('Minijournal::Article::Default::article-form.html.twig', array());
            }else
                throw new Exception("Access Denied : You don't have permission to execute this action");
        } else {
            $_SESSION["missed_uri"] = $this->http->getRequestUri();
            $this->redirect("/login");
        }

    }
    public function editAction($id)
    {
        if ($this->user->isConnected()){
            if ($this->user->isGrantRole('ROLE_EDITOR')) {
                if ($this->request->isMethod('get')) {
                    $manager = new ArticleManager();
                    $article = $manager->find($id);
                    return $this->render('Minijournal::Article::Default::article-form.html.twig',
                                        array('article' => $article));
                }
            }else
                throw new Exception("Access Denied : You don't have permission to execute this action");
        }else {
            $_SESSION["missed_uri"] = $this->http->getRequestUri();
            $this->redirect("/login");
        }
    }
    public function removeAction($id)
    {
        if ($this->user->isConnected()){
            if ($this->user->isGrantRole('ROLE_EDITOR')) {
                $manager = new ArticleManager();
                $imageManager = new imageManager();
                $article = $manager->find($id);
                $images = $imageManager->findAllBy("articleId",$id);
                //var_dump($images);die;
                /****Suppression des images liées à l'article à supprimer*****/
                foreach ($images as $image) {
                    $imageManager->remove($image);
                    unlink('resources/public/uploads/images/articles/'.$image->getName());
                }
                $manager->remove($article);

                return $this->redirect("/article/list");
            }else
                throw new Exception("Access Denied : You don't have permission to execute this action");
        } else {
            $_SESSION["missed_uri"] = $this->http->getRequestUri();
            $this->redirect("/login");
        }
    }
}
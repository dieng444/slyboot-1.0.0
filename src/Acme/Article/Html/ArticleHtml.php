<?php
namespace Minijournal\Article\Html;

use Minijournal\Article\Entity\Article;
use Slyboot\Util\Encoder\HtmlEncoder;
/**
 * Class ArticleHtml : Renvoie les données à afficher
 * dans les différents templates
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class ArticleHtml
{
    /**
     * @method méthode permettant de renvoyer la
     * liste des de tous les articles après avoir
     * les nettoyés (encoder les entités html)
     * @param Article $articles : tableau d'articles
     */
	public function getListView($articles)
	{
	    /**
	     * Ici je fais appel sur chacun des attributs
	     * de l'article, la class HtmlEncoder spécifiquement
	     * à sa méthode encode, qui encodera ainsi les entités
	     * html probables dans les attributs de l'article.
	     * J'échange donc de tableau de données de telle sorte
	     * que le tableau renvoyé au final soit un tableau d'article
	     * déjà encodé.
	     */
	    $tab_articles = array();
	    foreach ($articles as $article) {
	        $article->setTitre(HtmlEncoder::encode($article->getTitre()));
	        $article->setChapo(substr(HtmlEncoder::encode($article->getChapo()),0,45)."...");
	        $tab_articles[] = $article;
	    }
	    return $tab_articles;
	}
	/**
	 * @method Méthode permettant de renvoyer un article donné.
	 * @param Article $article : l'article à renvoyer
	 */
	public function getDetailView(Article $article)
	{
	    /**
	     * Ici, je répète le même scénario d'encodage que celui
	     * de la méthode getLisView explicité précédemment.
	     * Rémarque : Le contenu n'est pas échappé, car il peut
	     * y avoir des liens dans le texte ou d'autres balises html
	     * vu que l'on utilise un éditeur de texte WisiWig
	     */
	    $article->setAuteur(HtmlEncoder::encode($article->getAuteur()));
	    $article->setTitre(HtmlEncoder::encode($article->getTitre()));
	    $article->setStatut(HtmlEncoder::encode($article->getStatut()));

	    return $article;
	}
}

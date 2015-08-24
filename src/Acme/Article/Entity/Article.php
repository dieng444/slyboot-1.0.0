<?php
namespace Minijournal\Article\Entity;

use Slyboot\Main\Entity\MainEntity;
/**
 * Class Article : Cette classe répresente l'article à manipuler
 * @author Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class Article extends MainEntity
{
	/**
	 * @var integer l'identifiant de l'article
	 */
	protected $id;
	/**
	 * @var String le titre de l'article
	 */
	protected $titre;
	/**
	 * @var Text le chapo de l'article
	 */
    protected $chapo;
    /**
     * @var Text le contenu de l'article
     */
    protected $contenu;
    /**
     * @var String l'auteur de l'article
     */
    protected $auteur;
    /**
     * @var String le statut de l'article
     */
    protected $statut;
    /**
     * @var Date la date de création de l'article
     */
    protected $dateDeCreation;
    /**
     * @var Date date de publication de l'article
     */
    protected $dateDePublication;
    /**
     * @var Les images associées à l'article
     */
    protected $images = array();
    /**
     * @method constructeur de la classe faisant appel
     * au constructeur de la classe parente
     * @param array $data le tableau des données proveant du formulaire
     */
    public function __construct($data=array())
    {
        parent::__construct($data);
    }
    /**
     * @method Cette méthode permet de vérifier si un article est nouveau ou pas
     * si oui, alors il inséré comme nouveau article, sinon il est modifié vu
     * qu'il existe déjà.
     * @return boolean
     **/
    /*public function isNew()
    {
    	if(empty($this->id)){
    		return true;
    	}else
    		return false;
    }*/
    /**
     * @method Cette méthode renvois l'identifiant de l'article
     * @return integer
     */
    public function getId()
    {
    	return $this->id;
    }
    /**
     * @method Cette méthode permet d'ajouter l'identiant de l'article
     * @param integer $id
     * @return void
     */
    public function setId($id)
    {
    	$this->id = $id;
    }
    /**
     * @method Cette méthode renvois le titre de l'article
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * @method Cette méthode permet de modifier le titre de l'article
     * @param string $titre
     * @return void
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    /**
     * @method Cette méthode renvois le chapo de l'article
     * @return string
     */
    public function getChapo()
    {
        return $this->chapo;
    }
    /**
     * @method Cette méthode permet de modifier le chapo de l'article
     * @param string $chapo
     * @return void
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }
    /**
     * @method Cette méthode renvois le contenu de l'article
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    /**
     * @method Cette méthode permet de modifier le contenu de l'article
     * @param string $contenu
     * @return void
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
    /**
     * @method Cette méthode renvois l'auteur de l'article
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    /**
     * @method Cette méthode permet d'ajouter l'auteur de l'article
     * @param string $auteur
     * @return void
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }
    /**
     * @method Cette méthode renvois le statut de l'article
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
    /**
     * @method Cette méthode permet de modifier le statut de l'article
     * @param string $statut
     * @return void
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
    /**
     * @method Cette méthode renvois la date de création de l'article
     * @return string
     */
    public function getDateDeCreation(){

        return $this->dateDeCreation;
    }
    /**
     * @method Cette méthode permet de d'ajouter la date de création de l'article
     * @param string $statut
     * @return void
     */
    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;
    }
    /**
     * @method Cette méthode renvoie la date de publication de l'article
     * @return string
     */
    public function getDateDePublication()
    {
        return $this->dateDePublication;
    }
    /**
     * @method Cette méthode permet de de modifier la date de publication de l'article
     * @param string $statut
     * @return void
     */
    public function setDateDePublication($dateDePublication)
    {
        $this->dateDePublication = $dateDePublication;
    }
    /**
     * @method renvoie les images associées à l'article
     * @return array tableau d'images
     */
    public function getImages()
    {
         return $this->images;
    }
    /**
     * @method modifie les images associées à l'article
     * @param $images tableau d'images
     * @return void
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }
}

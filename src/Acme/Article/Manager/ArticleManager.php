<?php
namespace Minijournal\Article\Manager;

use Slyboot\Main\Manager\MainManager;
use Slyboot\Main\Entity\MainEntity;
/**
 * Class ArticleManager : cette classe gère tout ce qui est
 * inétractions avec la base de données.
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class ArticleManager extends MainManager
{
    /**
     * @var string : le nom de la table sur laquelle
     * les opérations vont s'effectuées.
     */
	const TABLE_NAME = 'articles';
	/**
	 * @var string :namespace de la classe
	 * courante
	 */
    const OBJ_CLASS_NAME = '\\Minijournal\\Article\\Entity\\Article';
    /**
     * @static méthode static renvoyant la
     * chaîne de réquête sql à exécuter à la classe
     * parente
     * @return string
     */
    protected static function getRequete()
    {
        $requete = ' SET titre = :titre, chapo = :chapo,
                    contenu = :contenu, auteur = :auteur,
                    statut = :statut, dateDeCreation = NOW(),
                    dateDePublication = NOW()';

        return $requete;
    }
    /**
     * @static : méthode static permettant
     * d'exécuter les réquête sql
     * @param $stm : la réquête à exécuter
     * @param $article : l'objet article sur lequel
     * l'exécution doit s'effectuer
     * @param $mode : le mode d'exécution de la requête
     * (insert ou update)
     * @return void
     */
    protected static function bind($stm,MainEntity $article,$mode)
    {
        if ($mode =='update') {
           $stm->bindValue(':id',(int)$article->getId());
        }
        $stm->bindValue(':titre',$article->getTitre());
		$stm->bindValue(':chapo',$article->getChapo());
		$stm->bindValue(':contenu',$article->getContenu());
		$stm->bindValue(':auteur',$article->getAuteur());
		$stm->bindValue(':statut',$article->getStatut());

		$stm->execute();
    }

}


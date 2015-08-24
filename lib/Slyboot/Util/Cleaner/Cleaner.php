<?php
namespace Slyboot\Util\Cleaner;
/**
 * Class Cleaner : gestionnaire des nettoyeurs
 * permettant d'ajouter des nettoyeurs.
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class Cleaner
{
    /**
     * tableau conteneur des nettoyeurs
     * @var unknown_type
     */
    private $cleanerContainer = array();
    /**
     * @method méthode permettant d'ajouter des nettoyeurs
     * au gestionnaire.
     * @param array $cleaners : tableau de nettoyeurs
     * @param array $data : données à nettoyer
     * @return array
     */
    public function addCleaner($cleaners,$data)
    {
        $this->cleanerContainer = $cleaners;
        /**
         * Ici sur chacun des nettoyeurs, j'applique sa
         * méthode cleaneup qui effectue le nettoyage en question.
         */
        foreach ($this->cleanerContainer as $cleaner) {

            $cleaner::cleanup(array(),$data);
        }
        return $data;
    }
}
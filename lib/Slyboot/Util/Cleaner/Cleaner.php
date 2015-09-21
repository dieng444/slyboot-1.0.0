<?php
namespace Slyboot\Util\Cleaner;

/**
 * Class Cleaner : Cleaner manager, allows to add cleaner
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
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
    public function addCleaner($cleaners, $data)
    {
        $this->cleanerContainer = $cleaners;
        /**
         * Ici sur chacun des nettoyeurs, j'applique sa
         * méthode cleaneup qui effectue le nettoyage en question.
         */
        foreach ($this->cleanerContainer as $cleaner) {
            $cleaner::cleanup($data, array());
        }
        return $data;
    }
}

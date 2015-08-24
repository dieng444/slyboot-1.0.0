<?php
namespace Minijournal\Article\cleaner;

use Slyboot\Util\Cleaner\Cleaner;
use Slyboot\Util\Cleaner\CleanerInterface;
/**
 * Class ArticleCleaner : classe de gestionnaire
 * des nettoyeurs qui gère les classes de nettoyages
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class ArticleCleaner implements CleanerInterface
{
    /**
     * Variable d'instance de la classe utilitaire
     * qui gère les nettoeyrs.
     * @var \Utils\Cleaners\Cleaner
     */
    private static $class;
    /**
     * @static méthode static appellant
     * le gestionnaire d'utilitaire des
     * nettoyeurs pour ainsi effectuer le nettoyage
     * @param array $cleaners : tabeleau de nettoyeurs
     * @param array $data : données à nettoyer
     */
    public static function cleanup($cleaners,$data)
    {
        self::$class = new Cleaner();

        $cleanData = self::$class->addCleaner($cleaners,$data);

        return $cleanData;
    }
}
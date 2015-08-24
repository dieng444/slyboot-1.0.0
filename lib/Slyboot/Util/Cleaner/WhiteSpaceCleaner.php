<?php
namespace Slyboot\Util\Cleaner;

use Slyboot\Util\Cleaner\CleanerInterface;
/**
 * Class WhiteSpaceCleaner : nettoyeur des espaces
 * de début et de fin de chaînes.
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class WhiteSpaceCleaner implements CleanerInterface
{
    /**
     * @method cette méthode permet d'enlever des espaces
     * au début et à la fin des différents champs.
     * @param array $data : tableau de données à nettoyer
     * */
    public static function cleanup($cleaners=array(), $data)
    {
        $tabValues = array();
        $data = &$data;
        foreach ($data as $key => $value ) {

            $tabValues[$key] = trim($value);
        }

        $data = $tabValues;
    }
}
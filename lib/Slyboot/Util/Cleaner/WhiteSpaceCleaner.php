<?php
namespace Slyboot\Util\Cleaner;

use Slyboot\Util\Cleaner\CleanerInterface;

/**
 * Class WhiteSpaceCleaner : Allows to remove white space in data
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 **/
class WhiteSpaceCleaner implements CleanerInterface
{
    /**
     * @method cette méthode permet d'enlever des espaces
     * au début et à la fin des différents champs.
     * @param array $data : tableau de données à nettoyer
     * */
    public static function cleanup($data, $cleaners = array())
    {
        $tabValues = array();
        $data = &$data;
        foreach ($data as $key => $value) {
            $tabValues[$key] = trim($value);
        }

        $data = $tabValues;
    }
}

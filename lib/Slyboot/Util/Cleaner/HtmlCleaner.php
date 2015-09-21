<?php
namespace Slyboot\Util\Cleaner;

use Slyboot\Util\Cleaner\CleanerInterface;

/**
 * Class HtmlCleaner : nettoyeur HTML
 * permettant de nettoyer les balises html
 * @author Elhadj Macky Dieng
 * @copyright   M1DNR2I - 2015
 * @license : Académique
 */
class HtmlCleaner implements CleanerInterface
{
    /**
     * @method cette méthode permet d'enlever les balises html
     * dans le titre de l'article.
     * @param array $data : tableau de données à nettoyer
     * NB : Ici le & est mis devant la variable de tableau $data
     * afin de permettre à la function de pouvoir modifier le
     * contenu de la variable puis de renvoyer. Comme ça, tous les
     * nettoyeurs pourront nettoyer la même variable de données,
     * pour ainsi faire le nettoyage l'un après l'autre.
     */
    public static function cleanup($data, $cleaners = array())
    {
        $tabValues = array();
        $data = &$data;
        foreach ($data as $key => $value) {
            if ($key=="titre") {
                $value = strip_tags($value);
            }
            $tabValues[$key] = $value;
        }
        $data = $tabValues;
    }
}

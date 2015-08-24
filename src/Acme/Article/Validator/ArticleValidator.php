<?php
namespace Minijournal\Article\Validator;

use Slyboot\Util\Validator\ValidatorInterface;
use Slyboot\Util\Validator\Validator;
use Slyboot\Main\Entity\MainEntity;
/**
 * Class ArticleValidator : classe de gestionnaire
 * des validateurs qui gère les classes de validations
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class ArticleValidator implements ValidatorInterface
{
    /**
     * Variable d'instance de la classe utilitaire
     * qui gère les validateurs.
     * @var \Utils\Validators\Validator
     */
    private static $class;
    /**
     * @static méthode static appellant
     * le gestionnaire d'utilitaire des
     * validateurs, pour ainsi effectuer la validation
     * d'un article donné.
     * @param array $validators : tabeleau de validateurs
     * @param array $article : article à valider
     */
    public static function validate($validators,MainEntity $entity)
    {
        self::$class = new Validator();
        $result = self::$class->addValidator($validators, $entity);
        return $result;
    }
}
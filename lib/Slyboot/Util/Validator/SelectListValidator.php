<?php
namespace Slyboot\Util\Validator;

use Slyboot\Main\Entity\MainEntity;
use Slyboot\Util\Validator\ValidatorInterface;
/**
 * Class SelectListValidator : Class de validation
 * permettant de valider les champs de type liste
 * de sélection.
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license : Académique
 */
class SelectListValidator implements ValidatorInterface
{
    /**
     * @method méthode static permettant de valider le statut
     * de l'article.
     * @param Article $article : l'article à valider
     * @return array
     */
    public static function validate($validators=array(), MainEntity $entity)
    {
        $reflector = new \ReflectionClass($entity);
        $entityNamespace = $reflector->getNamespaceName();
        $className = $reflector->getName();
        $classShortName = $reflector->getShortName();
        $ns_parts = explode('\\',$entityNamespace);
        $entityFormNS = $ns_parts[0].'\\'.$ns_parts[1].'\\'.'Form'.'\\'.$classShortName.'Form';
        $entityForm = new $entityFormNS();
        $validateInfos = $entityForm->getValidationInfos();
        //return $validateInfos['chapo']['options']['accepted_values'];
        $is_data_valid = true;
        $errors = array();
        if (sizeof($validateInfos) > 0) {
            foreach ($validateInfos as $key => $value) {
                $getter = 'get'.ucfirst($key);
                if (method_exists($entity,$getter)) {
                    if (array_key_exists('_accepted_values',$value['options'])) {
                        //var_dump($entity->$getter());die;
                        //var_dump($value['options']['_accepted_values']);die;
                        if (!in_array($entity->$getter(),$value['options']['_accepted_values'])) {
                            //var_dump($value['options']['accepted_values']);die;
                            $is_data_valid = false;
                            $errors[$key] = $value["options"]["_accepted_values_msg"];
                        }
                    }
                }else
                    throw new \Exception("Unexisting method exception :
                            method {$getter} does not exist in entity {$className}");
            }
            if ($is_data_valid) {
                return true;
            }else
                return $errors;
        }else
            throw new \Exception("No validation infos are specified");
    }
}
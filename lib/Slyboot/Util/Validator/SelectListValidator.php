<?php
namespace Slyboot\Util\Validator;

use Slyboot\Main\Entity\MainEntity;
use Slyboot\Util\Validator\ValidatorInterface;

/**
 * Class SelectListValidator : Allows to validate field
 * of type list (balise select html)
 * de sélection.
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 - the author
 **/
class SelectListValidator implements ValidatorInterface
{
    /**
     * Allows to validate select list fields
     * @param MainEntity $entity
     * @param unknown_type $validators
     * @throws \Exception
     */
    public static function validate(MainEntity $entity, $validators = array())
    {
        $reflector = new \ReflectionClass($entity);
        $entityNamespace = $reflector->getNamespaceName();
        $className = $reflector->getName();
        $classShortName = $reflector->getShortName();
        $ns_parts = explode('\\', $entityNamespace);
        $entityFormNS = $ns_parts[0].'\\'.$ns_parts[1].'\\'.'Form'.'\\'.$classShortName.'Form';
        $entityForm = new $entityFormNS();
        $validateInfos = $entityForm->getValidationInfos();
        $is_data_valid = true;
        $errors = array();
        if (sizeof($validateInfos) > 0) {
            foreach ($validateInfos as $key => $value) {
                $getter = 'get'.ucfirst($key);
                if (method_exists($entity, $getter)) {
                    if (array_key_exists('_accepted_values', $value['options'])) {
                        if (!in_array($entity->$getter(), $value['options']['_accepted_values'])) {
                            $is_data_valid = false;
                            $errors[$key] = $value["options"]["_accepted_values_msg"];
                        }
                    }
                } else {
                    throw new \Exception("Unexisting method exception :
                            method {$getter} does not exist in entity {$className}");
                }
            }
            if ($is_data_valid) {
                return true;
            } else {
                return $errors;
            }
        } else {
            throw new \Exception("No validation infos are specified");
        }
    }
}

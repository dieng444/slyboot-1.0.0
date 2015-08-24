<?php
namespace Slyboot\Util\Validator;

use Slyboot\Main\Entity\MainEntity;
use Slyboot\Util\Validator\ValidatorInterface;

class EmptyFieldValidator implements ValidatorInterface
{
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
        $is_data_valid = true;
        $errors = array();
        if (sizeof($validateInfos) > 0) {
            foreach ($validateInfos as $key => $value) {
                $getter = 'get'.ucfirst($key);
                if (method_exists($entity,$getter)) {
                    if (array_key_exists('_blank',$value["options"])) {
                        if ($entity->$getter()===null && $value["options"]["_blank"]===false) {
                            $is_data_valid = false;
                            $errors[$key] = $value["options"]["_empty_error_msg"];
                        }
                    }
                }else
                    throw new Exception("Unexisting method exception :
                                       method {$getter} does not exist in entity {$className}");
            }
            if ($is_data_valid) {
                return true;
            }else
                return $errors;;
        }else
            throw new \Exception("No validation infos are specified");

    }
}
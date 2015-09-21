<?php
namespace Slyboot\Util\Validator;

use Slyboot\Main\Entity\MainEntity;

/**
 * Class MainValidator : Validators manager, allows to add
 * validators
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 - the author
 */
class MainValidator
{
    /**
     * @method Allows to add validators to the manager
     * @param array $validators : array of validators
     * @param MainEntity $entity : entity to validate
     * @return array
     */
    public function addValidator($validators, MainEntity $entity)
    {
        $result = array();
        foreach ($validators as $validator) {
            $result[] = $validator::validate($entity, array());
        }
        return $result;
    }
}

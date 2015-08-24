<?php
namespace Slyboot\Util\Validator;

use Slyboot\Main\Entity\MainEntity;

interface ValidatorInterface
{
    public static function validate($validators=array(),MainEntity $entity);
}
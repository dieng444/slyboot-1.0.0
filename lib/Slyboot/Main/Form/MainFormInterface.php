<?php
namespace Slyboot\Main\Form;

interface MainFormInterface
{
    public function getPost($postFieldName);
    public function getError($field);
    public function isValid();
}

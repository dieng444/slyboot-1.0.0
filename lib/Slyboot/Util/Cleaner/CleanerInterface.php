<?php
namespace Slyboot\Util\Cleaner;

interface CleanerInterface
{
    public static function cleanup($data, $cleaners = array());
}

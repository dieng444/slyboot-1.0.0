<?php
namespace Slyboot\Util\Security;

/**
 * Interface PasswordSecurityAgentInterface
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
interface PasswordSecurityAgentInterface
{
    public static function secure($password);
    public static function verify($password, $hash);
    public static function getHashedPasswordInfo($hash);
}

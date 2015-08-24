<?php
namespace Slyboot\Util\Security;

/**
 * Class PasswordSecurityAgent : Allows to secure user
 * password strongly
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class PasswordSecurityAgent implements PasswordSecurityAgentInterface
{
    /**
     * Secure the user password passed as parameter
     * @param string $password
     * @return string
     */
    public static function secure($password)
    {
        $hashedPasswod  = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10 ));
        if($hashedPasswod){
            return $hashedPasswod;
        }else
            echo "Password Hash Exception : An error are occurred during password hashed";
    }
    /**
     * Veirify whether the password submitted by the user
     * from the login form is an valid password.
     * @param srting $password password to verify
     * @param string $hash an valid hash of password
     * @return boolean
     */
    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
    /**
     * Return hashed password informations
     * @param string $hash
     * @return array
     */
    public static function getHashedPasswordInfo($hash)
    {
        $passwordinfo = password_get_info($hash);
        if ($passwordinfo) {
            return $passwordinfo;
        }else
            echo "Password getInfo Exception : An error
                 are occurred during geting password infos. It's seem like something wrong";
    }
}
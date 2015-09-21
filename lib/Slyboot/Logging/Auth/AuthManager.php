<?php
namespace Slyboot\Logging\Auth;

use Slyboot\Database\Database as DB;
use Front\AppConfigLoader;
use \Exception;

/**
 * Manages current user information and control his access level
 * @author Macky Dieng
 * @author Jean Marc Lecarpentier
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class AuthManager
{
    /**
     * The class instance
     * @var Slyboot\Logging\Auth\AuthManager
     */
    protected static $auth = null;
    /**
     * Contain the corrent user informations
     * @var array
     */
    private $currentUser;
    /**
     * @var PDO : PDO instance object variable
     */
    private $connexion;
    /**
     * Class constructor
     */
    private function __construct()
    {
        if (isset($_SESSION['currentUser'])) {
            $this->currentUser = $_SESSION['currentUser'];
        } else {
            $this->currentUser = array();
        }

        $this->connexion = DB::getInstance()->getConnexion();

    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (null === self::$auth) {
            self::$auth = new self();
        }
        return self::$auth;
    }
    /**
     * Checks whether the couple (login,password) of current user
     * is correct, if yes, filled the current user
     * information into a global variable.
     * @param string $password the user password
     * @param string $login the user login
     * @return void
     **/
    public function checkAuthentication($password, $login)
    {
        /**
         * Obtaining the userProvider class from
         * the app configuration loader
         */
        if ($this->connexion === null) {
            throw new Exception("Database Exception : You most specify database
                    connexion informations in the config file");
        } else {
            $config = AppConfigLoader::loadConfigurations();
            $userProvider = $config['userProvider'];
            $requete = $this->connexion->prepare('SELECT * from user
                                                where username = :login
                                                and password = :pwd');

            $requete->bindValue(':login', $login);
            $requete->bindValue(':pwd', $password);
            $requete->execute();
            $requete->setFetchMode(\PDO::FETCH_ASSOC);
            $data = $requete->fetch();
            if (count($data) > 0) {
                if (!empty($userProvider)) {
                    $this->currentUser = new $userProvider($data);
                    $this->synchroniser();
                } else {
                    throw new \Exception("No provider class detected, check the app/Front/AppconfigLoader
                                        file to add user provider class");
                }
            }
        }
    }
    /**
     * Checks whether the user is connected
     * @return boolean
     */
    public function isConnected()
    {
        if ($this->connexion === null) {
            throw new Exception("Database Exception : You most specify database
                    connexion informations in the config file");
        } else
            return !empty($this->currentUser);
    }
    /**
     * Return current user informations
     * @return object
     */
    public function getInfos()
    {
        if ($this->connexion === null) {
            throw new Exception("Database Exception : You most specify database
                    connexion informations in the app/config.php file\n");
        } else
            return $this->currentUser;
    }
    /**
     * Logout the user and destroy all the
     * session informations
     */
    public function logout()
    {
        if ($this->connexion === null) {
            throw new Exception("Database Exception : You most specify database
                    connexion informations in the config file");
        } else {
            $this->currentUser = array();
            $this->synchroniser();
        }
    }
    /**
     * Synchronize current user informations into
     * a global variable
     * @return void
     */
    private function synchroniser()
    {
        $_SESSION['currentUser'] = $this->currentUser;
    }
    /**
     * Checks whether the current user has some
     * permission, before executing certain action
     * @param string $role required role for the action
     * @return boolean
     */
    public function HasRole($role)
    {
        if ($this->connexion === null) {
            throw new Exception("Database Exception : You most specify database
                    connexion informations in the config file");
        } else {
            if (in_array($role, $this->currentUser->getRoles()))
                return true;
            else
                return false;
        }
    }
}

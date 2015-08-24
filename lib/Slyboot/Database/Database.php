<?php
namespace Slyboot\Database;

use \PDO as PDO;

/**
 * Singleton fournissant la connexion à la base de données.
 * @author Jean Marc Lecarpentier
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Database
{
    /**
    * $instance est privée pour implémenter le pattern Singleton
    * et être sûr qu'il n'y a qu'une et une seule instance
    */
    private static $instance;

    /**
    * propriété contenant le lien de connexion à la BD
    */
    protected $connexion;

    /**
    * constructeur privé qui initialise la connexion
    * @todo rendre le constructeur indépendant du nom des constantes
    */
    private function __construct()
    {
        /**
        * tableau d'options pour le réglage de la connexion
        * en particulier le mode d'erreur
        * et l'encodage de la connexion en UTF-8
        * mettre FETCH_ASSOC en mode par défaut est discutable.
        */
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        // création d'un objet PDO avec les constantes définies dans la configuration
        $this->connexion = new PDO(DSN, USER, PASSWD, $options);
    }

    /**
    * désactiver le clonage
    */
    private function __clone() {}

    /**
    * Méthode pour accéder à l'UNIQUE instance de la classe.
    *
    * @return l'instance du singleton
    */
    public static function getInstance()
    {
        if (! (self::$instance instanceof self)) {
          self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    * Accesseur de la connexion.
    *
    * @return PDO instance L'objet PDO à utiliser pour exécuter les requêtes.
    */
    public function getConnexion()
    {
        return $this->connexion;
    }
}

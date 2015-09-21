<?php
namespace Slyboot\Main\Manager;

use Slyboot\Main\Manager\MainManagerInterface;
use Slyboot\Database\Database as DB;
use Slyboot\Main\Entity\MainEntity;
use \PDO;

/**
 * Class MainManager : The main manager class
 * all sub manager classes inherit this class
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
abstract class MainManager implements MainManagerInterface
{
    /**
     * PDO instance variable
     * @var PDO
     */
    private $connexion;
    /**
     * Class constructor, initialize the PDO instance
     * variable
     */
    public function __construct()
    {
        $this->connexion = DB::getInstance()->getConnexion();
    }
    /**
     * Returns a specific entity object
     * from the id specified as parameter
     * @param int object id
     * @return MainEntitys\MainEntity
     */
    public function find($id)
    {
        $requete = $this->connexion->prepare('SELECT * from '
                        .static::TABLE_NAME.' where id = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $data = $requete->fetch();
        if (sizeof($data) > 0) {
            $class = static::OBJ_CLASS_NAME;
            $entity = new $class($data);

            return $entity;
        } else {
            return false;
        }
    }
    /**
     * Returns a specific entity object
     * corresponding to a filter
     * @param mixed $field the filter field name
     * @param mixed $value the filter value
     * @return \MainEntity\MainEntity
     */
    public function findBy($field, $value)
    {
        $requete = $this->connexion->prepare('SELECT * from '
                        .static::TABLE_NAME.' where '. $field .' = :'.$field);

        $requete->bindValue(':'.$field, $value);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $data = $requete->fetch();
        if ($data && sizeof($data) > 0) {
            $class = static::OBJ_CLASS_NAME;
            $entity = new $class($data);

            return $entity;
        } else {
            return false;
        }
    }
    /**
     * Returns many entity object corresponding to a filter
     * @param mixed $field the filter field name
     * @param mixed $value the filter value
     * @return array
     */
    public function findAllBy($field, $value)
    {
        $requete = $this->connexion->prepare('SELECT * from '
                .static::TABLE_NAME.' where '. $field .' = :'.$field);

        $requete->bindValue(':'.$field, $value);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $entity = static::OBJ_CLASS_NAME;
        $data = array();
        while (($row = $requete->fetch()) !== false) {
            $data[] = new $entity($row);
        }

        return $data;
    }
    /**
     * Returns a list of current entity object
     * @return array array of entity
     */
    public function findAll()
    {
        $requete = $this->connexion->prepare('SELECT * from '.
                        static::TABLE_NAME.'
                        order by dateDeCreation desc');

        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $entity = static::OBJ_CLASS_NAME;
        $data = array();
        while (($row = $requete->fetch()) !== false) {
            $data[] = new $entity($row);
        }

        return $data;
    }
    /**
     * Returns a limited list of current entity
     * @param mixed $limit limited specified by the user
     * @return array array of entity
     */
    public function findAllByLimit($limit)
    {
        $requete = $this->connexion->prepare('SELECT * from '.
                static::TABLE_NAME.'
                order by dateDeCreation desc limit '.$limit);

        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $entity = static::OBJ_CLASS_NAME;
        $data = array();
        while (($row = $requete->fetch()) !== false) {
            $data[] = new $entity($row);
        }

        return $data;
    }
    /**
     * Allows to add a new entity in database
     * @param $entity entity to add
     * @return boolean
     */
    public function add(MainEntity $entity)
    {
              
        $requete = $this->connexion->prepare('INSERT INTO '
                        .static::TABLE_NAME . static::getRequete());

        return static::bind($requete, $entity, 'insert');
    }
    /**
     * Conrol which action to execute (insert or upadte)
     * If the entity to manage is a new entity, then it will
     * just inserted in database by creating an new line in the
     * current object table. Otherwise, the entity is just updated
     * @param $entity entity to insert or update
     * @return boolean
     */
    public function save(MainEntity $entity)
    {
        if ($entity->isNew()) {
            return $this->add($entity);
        } else {
            return $this->update($entity);
        }
    }
    /**
     * Allows to update existing entity
     * @param MainEntity $entity entity to update
     * @return boolean
     */
    public function update(MainEntity $entity)
    {
        $requete = $this->connexion->prepare('UPDATE '
                .static::TABLE_NAME . static::getRequete() .
                'where id=:id');

        static::bind($requete, $entity, 'update');
    }
    /**
     * Allows to delete a existing object
     * @param MainEntity $entity entity to delete
     */
    public function remove(MainEntity $entity)
    {
        $requete = $this->connexion->prepare('DELETE FROM '
                        .static::TABLE_NAME.' WHERE id = :id');
        $requete->bindValue(':id', (int)$entity->getId());
        $requete->execute();
    }
    /**
     * Get the last inserted id of current object
     * @return boolean
     */
    public function lastInserId()
    {
        return $this->connexion->query('select max(id) from '
                .static::TABLE_NAME)->fetchColumn();
    }
}

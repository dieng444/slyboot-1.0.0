<?php
namespace Slyboot\Main\Manager;

use Slyboot\Main\Entity\MainEntity;

/**
 * Interface MainManagerInterface : classes mamanger interface
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
interface MainManagerInterface
{
    public function find($id);
    public function findAll();
    public function findBy($field, $value);
    public function findAllBy($field, $value);
    public function findAllByLimit($limit);
    public function add(MainEntity $entity);
    public function save(MainEntity $entity);
    public function update(MainEntity $entity);
    public function remove(MainEntity $entity);
    public function lastInserId();
}

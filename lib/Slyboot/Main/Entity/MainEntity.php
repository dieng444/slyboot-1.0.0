<?php
namespace Slyboot\Main\Entity;

use Slyboot\Main\Entity\MainEntityInterface;
use \Exception;

/**
 * Class MainEntity : The main entity class,
 * all sub entity class inherit this class
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
abstract class MainEntity implements MainEntityInterface
{
    /**
     * Class constructor
     * @method __construct
     * @param array $data : array of data
     * @return void
     */
    public function __construct($data)
    {
        if (!empty($data)) {
            $this->initialize($data);
        }
    }
    /**
     * Initialize subclass setters
     * @method initialize
     * @param array $data array of data
     * @return void
     */
    public function initialize($data = array())
    {
        foreach ($data as $attribut => $value) {
            if (!empty($value)) {
                $methode = 'set'.ucfirst($attribut);
                if (method_exists($this, $methode)) {
                    $this->$methode($value);
                }
            }
        }
    }
    /**
     * Checks if the current object is an new
     * or existing object.
     * @method isNew
     * @return boolean
     **/
    public function isNew()
    {
        if (static::getId()=== null) {
            return true;
        } else {
            return false;
        }
    }
}
